# Unit Tests

... write a test that made sure that every nook and cranny of that code worked as I expected it to. I would isolate my code from the operating system rather than just calling the standard timing functions. I would mock out those timing functions so that I had absolute control over the time. I would schedule commands that set boolean flags, and then I would step the time forward, watching those flags and ensuring that they went from false to true just as I changed the time to the right value.

Once I got a suite of tests to pass, I would make sure that those tests were convenient to run for anyone else who needed to work with the code. I would ensure that the tests and the code were checked in together into the same source package.

- The Three Laws of TDD

    - First Law You may not write production code until you have written a failing unit test.

    - Second Law You may not write more of a unit test than is sufficient to fail, and not compiling is failing.

    - Third Law You may not write more production code than is sufficient to pass the currently failing test.

- Keeping Tests Clean

The moral of the story is simple: Test code is just as important as production code.

It is not a second-class citizen. It requires thought, design, and care. It must be kept as clean as production code.
                
If you have tests, you do not fear making changes to the code! Without tests every change is a possible bug.
                
But with tests that fear virtually disappears. The higher your test coverage, the less your fear.
                
Indeed, you can improve that architecture and design without fear!
                
So having an automated suite of unit tests that cover the production code is the key to keeping your design and architecture as clean as possible. Tests enable all the -ilities, because tests enable change

- Clean Tests

What makes a clean test? Three things. Readability, readability, and readability.

What makes tests readable? The same thing that makes all code readable: clarity, simplicity, and density of expression.

The BUILD-OPERATE-CHECK pattern

- A Dual Standard

There are things that you might never do in a production environment that are perfectly fine in a test environment. Usually they involve issues of memory or CPU efficiency. But they never involve issues of cleanliness.

- One Assert per Test

I think the single assert rule is a good guideline.7 I usually try to create a domain-specific testing language that supports it,

But I am not afraid to put more than one assert in a test. I think the best thing we can say is that the number of asserts in a test ought to be minimized.

- Single Concept per Test

Perhaps a better rule is that we want to test a single concept in each test function.

We don’t want long test functions that go testing one miscellaneous thing after another.
                
So probably the best rule is that you should minimize the number of asserts per concept and test just one concept per test function.

- F.I.R.S.T.

Clean tests follow five other rules that form the above acronym:

Fast Tests should be fast. They should run quickly. When tests run slow, you won’t want to run them frequently. If you don’t run them frequently, you won’t find problems early enough to fix them easily. You won’t feel as free to clean up the code. Eventually the code will begin to rot.
                
Independent Tests should not depend on each other. One test should not set up the conditions for the next test.
                
You should be able to run each test independently and run the tests in any order you like.
                
Repeatable Tests should be repeatable in any environment. You should be able to run the tests in the production environment, in the QA environment, and on your laptop while riding home on the train without a network. If your tests aren’t repeatable in any environment, then you’ll always have an excuse for why they fail. You’ll also find yourself unable to run the tests when the environment isn’t available.
                
Self-Validating The tests should have a boolean output. Either they pass or fail. You should not have to read through a log file to tell whether the tests pass.
                
Timely The tests need to be written in a timely fashion. Unit tests should be written just before the production code that makes them pass. If you write tests after the production code, then you may find the production code to be hard to test. You may decide that some production code is too hard to test. You may not design the production code to be testable.

- Conclusion

Tests are as important to the health of a project as the production code is. Perhaps they are even more important, because tests preserve and enhance the flexibility, maintainability, and reusability of the production code.
                
If you let the tests rot, then your code will rot too. Keep your tests clean.