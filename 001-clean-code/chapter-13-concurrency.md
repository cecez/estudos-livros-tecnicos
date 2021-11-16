# Concurrency

- Recommendation: Keep your concurrency-related code separate from other code.

Corollary: Limit the Scope of Data As we saw, two threads modifying the same field of a shared object can interfere with each other, causing unexpected behavior. One solution is to use the synchronized keyword to protect a critical section in the code that uses the shared object. It is important to restrict the number of such critical sections.
                

- Recommendation: Take data encapsulation to heart; severely limit the access of any data that may be shared.
                

Corollary: Use Copies of Data A good way to avoid shared data is to avoid sharing the data in the first place. In some situations it is possible to copy objects and treat them as read-only. In other cases it might be possible to copy objects, collect results from multiple threads in these copies and then merge the results in a single thread.
                

- Recommendation: Attempt to partition data into independent subsets than can be operated on by independent threads, possibly in different processors.
                

- Know Your Library
    - Recommendation: Review the classes available to you. In the case of Java, become familiar with java.util.concurrent, java.util.concurrent.atomic, java.util.concurrent.locks.
                
- Producer-Consumer
    - The queue between the producers and consumers is a bound resource.
    - This means producers must wait for free space in the queue before writing and consumers must wait until there is something in the queue to consume. Coordination between the producers and consumers via the queue involves producers and consumers signaling each other.
    - The producers write to the queue and signal that the queue is no longer empty.
    - Consumers read from the queue and signal that the queue is no longer full. Both potentially wait to be notified when they can continue.
                

- Readers-Writers
                
- Dining Philosophers
                
Most concurrent problems you will likely encounter will be some variation of these three problems. Study these algorithms and write solutions using them on your own so that when you come across concurrent problems, you’ll be more prepared to solve the problem. Recommendation: Learn these basic algorithms and understand their solutions.
                

- Beware Dependencies Between Synchronized Methods 
    - Dependencies between synchronized methods cause subtle bugs in concurrent code. The Java language has the notion of synchronized, which protects an individual method. However, if there is more than one synchronized method on the same shared class, then your system may be written incorrectly.12 Recommendation: Avoid using more than one method on a shared object.
                

- Keep Synchronized Sections Small 
    - The synchronized keyword introduces a lock. All sections of code guarded by the same lock are guaranteed to have only one thread executing through them at any given time. Locks are expensive because they create delays and add overhead. So we don’t want to litter our code with synchronized statements. On the other hand, critical sections13 must be guarded. So we want to design our code with as few critical sections as possible.
                

- Recommendation: Keep your synchronized sections as small as possible.
                
- Testing Threaded Code
    - Recommendation: Write tests that have the potential to expose problems and then run them frequently, with different programatic configurations and system configurations and load. If tests ever fail, track down the failure. Don’t ignore a failure just because the tests pass on a subsequent run.

