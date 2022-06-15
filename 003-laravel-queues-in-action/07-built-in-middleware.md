# Built-in Middleware
## Preventing job overlapping
This middleware uses atomic locks under the hood to prevent the overlapping. The lock will be released automatically after the currently running instance runs successfully or fails. However, if the worker crashes or hangs, the lock will remain and prevent other instances from running ever. That's why it's always a good idea to set an expiration for locks:

Using expireAfter(), the lock will be released 10 seconds after the job is attempted.
```php
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\Middleware\WithoutOverlapping;
class UpdateBalanceJob implements ShouldQueue
{
    // The job handle method...
    public function middleware()
    {
        return [
            (new WithoutOverlapping())->expireAfter(10)
        ]; 
    }
}
```
## Rate Limiting
Laravel also ships with a RateLimited job middleware. To use it, you need to define a rate limiter in one of your service providers:
```php
public function boot()
{
    RateLimiter::for('reports', function ($job) {
        return $job->customer->onPremiumPlan()
            ? Limit::perHour(100)->by($job->customer->id)
            : Limit::perHour(10)->by($job->customer->id);
    }); 
}

// Now you can use this limiter in your jobs:
use Illuminate\Queue\Middleware\RateLimited;
// ...
public function middleware()
{
    return [
        new RateLimited('reports')
    ]; 
}
```