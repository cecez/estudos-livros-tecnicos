# Keeping the Workers Running
A worker is a PHP process that's supposed to run indefinitely. However, it may exit for several reasons:
- Reaching the memory limit
- A job timing out
- Losing connection with the database 
- Process crashing

## Avoiding memory leaks
With a process manager like Supervisor in place, you can restart your workers every hour to clean the memory knowing that Supervisor will start them back for you automatically.

To do this, you can configure a CRON job to run every hour and call the queue:restart command:
```
0 * * * * forge php /home/forge/laravel.com/artisan queue:restart
```
If you don't want to use a CRON task, you can use the --max-jobs and --max-time options to limit the number of jobs the worker may process, or the time it should stay up:
```
php artisan queue:work --max-jobs=1000 --max-time=3600
```
This worker will automatically exit after processing 1000 jobs or after running for an hour.

Finally, you may signal the worker to exit from within a job handle method:
```php
public function handle()
{
    // Run the job logic.
    app('queue.worker')->shouldQuit = 1;
}
```
This method can be useful if you know this specific type of job could be memory consuming and you want to make sure the worker restarts after processing it to free any reserved resources.

## Laravel Horizon
### Avoiding memory leaks
Similar to regular worker processes, the Horizon process is a long-living PHP process. We need to make sure we free the memory used by the Horizon process as well as all the child processes running after it.

We can use the same strategy we used with regular workers, signal Horizon to terminate every hour using CRON:
```
0 * * * * forge php /home/forge/laravel.com/artisan horizon:terminate
```
When the cron runs horizon:terminate, Horizon will send signals to all its workers to terminate after they finish running any job in hand.

After all workers terminate, the Horizon process itself will exit. That should be enough to free the memory from any leaks coming from the worker processes, or the Horizon process itself.
