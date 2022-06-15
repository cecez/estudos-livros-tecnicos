# Dealing with failure
A queue system involves 3 main players:
1. The producer 
2. The consumer 
3. The store

The producer enqueues messages, the consumer dequeues messages and processes them, and the store keeps messages until a consumer picks them up. All three players can live on the same machine or completely different machines.

Things can go wrong with any of these players, or the communication channels they use.

## Failing to send a job
If the job was successfully serialized to a string form, the next failure point could be sending that job to the queue store. Problems may happen due to the job payload being too large or a networking issue.

For networking issues, on the other hand, we need to have a retry mechanism in place to ensure our jobs aren't lost if the queue store didn't receive them. A simple way to do that is using the retry() helper:
```php
retry(2, function() {
    GenerateReport::dispatch();
}, 5000);
```
In this example, we will attempt to dispatch the job 2 times and sleep 5 seconds in between before throwing the exception.
## Dead Letter Queue
Notice: A dead letter is an undelivered piece of mail. A client-side dead letter queue is a queue store on the producer end where they keep queued messages that bounced.

...a SendOrderToSupplier job that's sent after the order is made is triggered automatically. If sending the job fails, we need to store it somewhere and keep retrying.
```php
$job = new SendOrderToSupplier($order);
try {
    retry(2, function () use ($job) {
        dispatch($job)->onQueue('high');
    }, 5000);
} catch (Throwable $e) {
    DB::table('dead_letter_queue')->insert([
        'message' => serialize(clone $job),
        'failed_at' => now()
    ]);
}
```
Here we store the job in a dead_letter_queue database table if we encounter failure while sending it. We can set up a CRON job to check the database table periodically and re-dispatch any dead letters.
```php
DB::table('dead_letter_queue')->take(50)->each(function($record) {
    try {
        dispatch(
            unserialize($record->message)
        );
    } catch (Throwable $e) {
        // Keep the job in the dead letter queue to be retried later.
return; }
    // Delete the job once it's successfully dispatched.
    DB::table('dead_letter_queue')->where('id', $record->id)->delete();
})
```