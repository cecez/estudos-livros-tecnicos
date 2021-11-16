# Smells and Heuristics

- Comments
    - Comments should be reserved for technical notes about the code and design.
    - If you find an obsolete comment, it is best to update it or get rid of it as quickly as possible.
    - A comment is redundant if it describes something that adequately describes itself.
    - Comments should say things that the code cannot say for itself.
    - If you are going to write a comment, take the time to make sure it is the best comment you can write.
    - Commented-out code is an abomination.
    - When you see commented-out code, delete it!
                

- Environment
    - E1: Build Requires More Than One Step
        - Building a project should be a single trivial operation.
    - E2: Tests Require More Than One Step
        - You should be able to run all the unit tests with just one command. In the best case you can run all the tests by clicking on one button in your IDE.
                

- Functions
    - F1: Too Many Arguments
    - F2: Output Arguments
    - F3: Flag Arguments Boolean arguments loudly declare that the function does more than one thing.
    - F4: Dead Function Methods that are never called should be discarded. Keeping dead code around is wasteful.
                

- General
    - G1: Multiple Languages in One Source File
        - The ideal is for a source file to contain one, and only one, language.
    - G3: Incorrect Behavior at the Boundaries
        - Don’t rely on your intuition. Look for every boundary condition and write a test for it.
    - G5: Duplication
        - Every time you see duplication in the code, it represents a missed opportunity for abstraction. That duplication could probably become a subroutine or perhaps another class outright.
        - A more subtle form is the switch/case or if/else chain that appears again and again in various modules, always testing for the same set of conditions. These should be replaced with polymorphism.
        - I think the point has been made. Find and eliminate duplication wherever you can.
    - G8: Too Much Information
        - A well-defined interface does not offer very many functions to depend upon, so coupling is low. A poorly defined interface provides lots of functions that you must call, so coupling is high. Good software developers learn to limit what they expose at the interfaces of their classes and modules.
        - Hide your data. Hide your utility functions. Hide your constants and your temporaries. Don’t create classes with lots of methods or lots of instance variables. Don’t create lots of protected variables and functions for your subclasses. Concentrate on keeping interfaces very tight and very small. Help keep coupling low by limiting information.
    - G9: Dead Code
        - When you find dead code, do the right thing. Give it a decent burial. Delete it from the system.
    - G10: Vertical Separation
        - Local variables should be declared just above their first usage and should have a small vertical scope.
        - Private functions should be defined just below their first usage.
    - G11: Inconsistency
        - Simple consistency like this, when reliably applied, can make code much easier to read and modify.
    - G12: Clutter
        - Keep your source files clean, well organized, and free of clutter.
    - G14: Feature Envy
        - The methods of a class should be interested in the variables and functions of the class they belong to, and not the variables and functions of other classes.
        - When a method uses accessors and mutators of some other object to manipulate the data within that object, then it envies the scope of the class of that other object.
    - G17: Misplaced Responsibility
        - One of the most important decisions a software developer can make is where to put code.
    - G18: Inappropriate Static
        - In general you should prefer nonstatic methods to static methods. When in doubt, make the function nonstatic. If you really want a function to be static, make sure that there is no chance that you’ll want it to behave polymorphically.
    - G19: Use Explanatory Variables Kent Beck wrote about this in his great book Smalltalk Best Practice Patterns8 and again more recently in his equally great book Implementation Patterns.9 One of the more powerful ways to make a program readable is to break the calculations up into intermediate values that are held in variables with meaningful names.
        - It is hard to overdo this. More explanatory variables are generally better than fewer. It is remarkable how an opaque module can suddenly become transparent simply by breaking the calculations up into well-named intermediate values.
    - G20: Function Names Should Say What They Do
    - G21: Understand the Algorithm
        - Before you consider yourself to be done with a function, make sure you understand how it works.
        - It is not good enough that it passes all the tests. You must know10 that the solution is correct.
        - Often the best way to gain this knowledge and understanding is to refactor the function into something that is so clean and expressive that it is obvious how it works.
    - G23: Prefer Polymorphism to If/Else or Switch/Case
    - G24: Follow Standard Conventions
        - The team should not need a document to describe these conventions because their code provides the examples.
    - G25: Replace Magic Numbers with Named Constants
    - G28: Encapsulate Conditionals
        - Extract functions that explain the intent of the conditional. For example:    if (shouldBeDeleted(timer)) is preferable to    if (timer.hasExpired() && !timer.isRecurrent())
    - G29: Avoid Negative Conditionals
    - G30: Functions Should Do One Thing
    - G34: Functions Should Descend Only One Level of Abstraction
        - Separating levels of abstraction is one of the most important functions of refactoring, and it’s one of the hardest to do well.
    - G35: Keep Configurable Data at High Levels If you have a constant such as a default or configuration value that is known and expected at a high level of abstraction, do not bury it in a low-level function. Expose it as an argument to that low-level function called from the high-level function.
    - G36: Avoid Transitive Navigation In general we don’t want a single module to know much about its collaborators. More specifically, if A collaborates with B, and B collaborates with C, we don’t want modules that use A to know about C. (For example, we don’t want a.getB().getC().doSomething();.) This is sometimes called the Law of Demeter. The Pragmatic Programmers call it “Writing Shy Code.”12 In either case it comes down to making sure that modules know only about their immediate collaborators and do not know the navigation map of the whole system.
                
- Java
    - Java J1: Avoid Long Import Lists by Using Wildcards
        - If you use two or more classes from a package, then import the whole package with    import package.*;
    - J2: Don’t Inherit Constants
        - A programmer puts some constants in an interface and then gains access to those constants by inheriting that interface.
        - Use a static import instead.
    - J3: Constants versus Enums
        - Now that enums have been added to the language (Java 5), use them! Don’t keep using the old trick of public static final ints.
                

- Names 
    - N1: Choose Descriptive Names Don’t be too quick to choose a name. Make sure the name is descriptive. Remember that meanings tend to drift as software evolves, so frequently reevaluate the appropriateness of the names you choose. This is not just a “feel-good” recommendation. Names in software are 90 percent of what make software readable. You need to take the time to choose them wisely and keep them relevant. Names are too important to treat carelessly.
    - N2: Choose Names at the Appropriate Level of Abstraction
        - Don’t pick names that communicate implementation; choose names the reflect the level of abstraction of the class or function you are working in. This is hard to do. Again, people are just too good at mixing levels of abstractions. Each time you make a pass over your code, you will likely find some variable that is named at too low a level. You should take the opportunity to change those names when you find them.
    - N3: Use Standard Nomenclature Where Possible
    - N4: Unambiguous Names
    - N5: Use Long Names for Long Scopes
    - N7: Names Should Describe Side-Effects Names should describe everything that a function, variable, or class is or does. Don’t hide side effects with a name. Don’t use a simple verb to describe a function that does more than just that simple action.
                

- Tests 
    - T1: Insufficient Tests How many tests should be in a test suite? Unfortunately, the metric many programmers use is “That seems like enough.” A test suite should test everything that could possibly break.
    - T2: Use a Coverage Tool! Coverage tools reports gaps in your testing strategy. They make it easy to find modules, classes, and functions that are insufficiently tested.
    - T3: Don’t Skip Trivial Tests They are easy to write and their documentary value is higher than the cost to produce them.
    - T4: An Ignored Test Is a Question about an Ambiguity
    - T5: Test Boundary Conditions
    - T6: Exhaustively Test Near Bugs
    - T8: Test Coverage Patterns Can Be Revealing Looking at the code that is or is not executed by the passing tests gives clues to why the failing tests fail. T9: Tests Should Be Fast A slow test is a test that won’t get run. When things get tight, it’s the slow tests that will be dropped from the suite. So do what you must to keep your tests fast.