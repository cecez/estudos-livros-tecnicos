# The Command Bus
- Dispatching a job to the queue
```php
use Illuminate\Support\Facades\Bus;
Bus::dispatchToQueue(
    new SendInvoice($order)
);
```
- Dispatching a Job Immediately
```php
Bus::dispatchNow(new RestartNginx());
```
- Dispatching a Job After Response
  - **Warning**: This is only a good idea if the task is really short. For long- running tasks, dispatching to the queue is recommended.
```php
Bus::dispatchAfterResponse(new ReleaseLocks());

return response('OK!');
```
- Dispatching a Chain
  - **Notice**: Jobs in a chain run one after another. Here, the Deploy job will not run unless the RunTests job runs successfully.
```php
Bus::chain([
    new DownloadRepo,
    new RunTests,
    new Deploy
])->dispatch();
```
- Dispatching a Batch
  - By default, the entire batch will be marked as failed if any of the jobs fail. You can change this behavior by using the allowFailures() method.
```php
Bus::batch([
    // ...
])
->catch(function () {
    // A batch job has failed!
})
->then(function () {
    // All jobs have successfully run!
})
->finally(function () {
    // All jobs have run! Some may have failed.
})
->dispatch();
```
- Using the dispatch() Helper
```php
// to the queue (if implements SendInvoice implements ShouldQueue, otherwise immediately.
dispatch(
    new SendInvoice($order)
);

// after response
dispatch(
    new SendInvoice($order)
)
->afterResponse();

// after any open database transaction commits
dispatch(
    new SendInvoice($order)
)
->afterCommit();
```
- Using the dispatch() Static Method
```php
SendInvoice::dispatch($order);
```