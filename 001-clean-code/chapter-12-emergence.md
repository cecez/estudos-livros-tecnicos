# Emergence

Getting Clean via Emergent Design

According to Kent, a design is “simple” if it follows these rules:
- Runs all the tests 
- Contains no duplication 
- Expresses the intent of the programmer 
- Minimizes the number of classes and methods
                

The rules are given in order of importance. 

- Simple Design Rule 1: Runs All the Tests
    - First and foremost, a design must produce a system that acts as intended. A system might have a perfect design on paper, but if there is no simple way to verify that the system actually works as intended, then all the paper effort is questionable. A system that is comprehensively tested and passes all of its tests all of the time is a testable system. That’s an obvious statement, but an important one. Systems that aren’t testable aren’t verifiable. Arguably, a system that cannot be verified should never be deployed.
                

- Simple Design Rules 2–4: Refactoring
    - Once we have tests, we are empowered to keep our code and classes clean. We do this by incrementally refactoring the code. For each few lines of code we add, we pause and reflect on the new design.
                
                
- No Duplication
    - Duplication is the primary enemy of a well-designed system. It represents additional work, additional risk, and additional unnecessary complexity.
    - Creating a clean system requires the will to eliminate duplication, even in just a few lines of code.
                

- Expressive
    - It’s easy to write code that we understand, because at the time we write it we’re deep in an understanding of the problem we’re trying to solve. Other maintainers of the code aren’t going to have so deep an understanding.
    - The majority of the cost of a software project is in long-term maintenance. In order to minimize the potential for defects as we introduce change, it’s critical for us to be able to understand what a system does.
    - You can express yourself by choosing good names.
    - You can also express yourself by keeping your functions and classes small. Small classes and functions are usually easy to name, easy to write, and easy to understand.
    - You can also express yourself by using standard nomenclature. Design patterns, for example, are largely about communication and expressiveness.
    - Well-written unit tests are also expressive. A primary goal of tests is to act as documentation by example. Someone reading our tests should be able to get a quick understanding of what a class is all about.
    - But the most important way to be expressive is to try. All too often we get our code working and then move on to the next problem without giving sufficient thought to making that code easy for the next person to read. Remember, the most likely next person to read the code will be you.
    - So take a little pride in your workmanship. Spend a little time with each of your functions and classes. Choose better names, split large functions into smaller functions, and generally just take care of what you’ve created. Care is a precious resource.
                

- Minimal Classes and Methods
    - Our goal is to keep our overall system small while we are also keeping our functions and classes small. Remember, however, that this rule is the lowest priority of the four rules of Simple Design. So, although it’s important to keep class and function count low, it’s more important to have tests, eliminate duplication, and express yourself.
                

- Conclusion 
    - Is there a set of simple practices that can replace experience? Clearly not. On the other hand, the practices described in this chapter and in this book are a crystallized form of the many decades of experience enjoyed by the authors. Following the practice of simple design can and does encourage and enable developers to adhere to good principles and patterns that otherwise take years to learn.
                

- Extreme Programming Explained: Embrace Change,

