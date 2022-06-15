# Dealing with Redis
Being an in-memory key-value store gives Redis a speed edge. However, memory isn't cheap, you need to be careful with the amount of memory your queues use so that you don't end up paying too much.
## Keeping Memory Usage Under Control
To keep memory usage under control, you need to work on two things:
1. Ensure the size of a job payload is as small as possible.
2. Ensure there are enough workers running to process jobs as fast as possible
## Persisting jobs to disk
Memory is volatile. If the server restarts while there are jobs in your queues, those jobs will be lost.

If you want, you can configure Redis to persist data on disk, either by writing to disk on fixed intervals or logging all incoming commands in an append-only fashion.

If the server is restarted, it can use the data written to disk to recover the Redis memory. You can read more on the persistence options in the Redis Guide (https://redis.io/topics/persistence).