# Managing the state
When you start a worker process, a single application instance is booted up and stored in memory. All jobs processed by this worker will be using that same application instance and the same shared memory. That means values stored in static properties are going to be re-used between jobs, same goes for container bindings.