# Chapter 3: Functions

Small! The first rule of functions is that they should be small.

Lines should not be 150 characters long. Functions should not be 100 lines long. Functions should hardly ever be 20 lines long.
                
**Blocks and Indenting**

This implies that the blocks within if statements, else statements, while statements, and so on should be one line long.
                
Probably that line should be a function call.
                
**Do One Thing**
                
FUNCTIONS SHOULD DO ONE THING. THEY SHOULD DO IT WELL. THEY SHOULD DO IT ONLY.
                
If a function does only those steps that are one level below the stated name of the function, then the function is doing one thing.
                
So, another way to know that a function is doing more than “one thing” is if you can extract another function from it with a name that is not merely a restatement of its implementation [G34].

```java
// Listing 3-4 Payroll.java
public Money calculatePay(Employee e) throws InvalidEmployeeType {
    switch (e.type) {
    case COMMISSIONED:
        return calculateCommissionedPay(e);
    case HOURLY:
        return calculateHourlyPay(e);
    case SALARIED:
        return calculateSalariedPay(e);
    default:
        throw new InvalidEmployeeType(e.type);
    }
}
```
There are several problems with this function. First, it’s large, and when new employee types are added, it will grow. Second, it very clearly does more than one thing. Third, it violates the Single Responsibility Principle7 (SRP) because there is more than one reason for it to change. Fourth, it violates the Open Closed Principle8 (OCP) because it must change whenever new types are added. But possibly the worst problem with this function is that there are an unlimited number of other functions that will have the same structure.

The solution to this problem (see Listing 3-5) is to bury the switch statement in the basement of an ABSTRACT FACTORY.

My general rule for switch statements is that they can be tolerated if they appear only once, are used to create polymorphic objects, and are hidden behind an inheritance relationship so that the rest of the system can’t see them [G23]. Of course every circumstance is unique, and there are times when I violate one or more parts of that rule. 

```java
// Listing 3-5 
public abstract class Employee {
    public abstract boolean isPayday();
    public abstract Money calculatePay();
    public abstract void deliverPay(Money pay);
}

public interface EmployeeFactory {
    public Employee makeEmployee(EmployeeRecord r) throws InvalidEmployeeType;
}

public class EmployeeFactoryImpl implements EmployeeFactory {
    public Employee makeEmployee(EmployeeRecord r) throws InvalidEmployeeType {
        switch (r.type) {
        case COMMISSIONED:
            return new CommissionedEmployee(r);
        case HOURLY:
            return new HourlyEmployee(r);
        case SALARIED:
            return new SalariedEmploye(r);
        default:
            throw new InvalidEmployeeType(r.type);
        }
    }
}
```

Use Descriptive Names

Don’t be afraid to spend time choosing a name.
                
**Function Arguments** 

The ideal number of arguments for a function is zero (niladic). Next comes one (monadic), followed closely by two (dyadic). Three arguments (triadic) should be avoided where possible. More than three (polyadic) requires very special justification—and then shouldn’t be used anyway.
                
Arguments are even harder from a testing point of view. Imagine the difficulty of writing all the test cases to ensure that all the various combinations of arguments work properly.
                
If there are no arguments, this is trivial.
                
**Flag Arguments** 

Flag arguments are ugly. Passing a boolean into a function is a truly terrible practice. It immediately complicates the signature of the method, loudly proclaiming that this function does more than one thing. It does one thing if the flag is true and another if the flag is false!
                
Command Query Separation Functions should either do something or answer something, but not both.

Doing both often leads to confusion. Consider, for example, the following function:    

```java
public boolean set(String attribute, String value); 
```

This function sets the value of a named attribute and returns true if it is successful and false if no such attribute exists. This leads to odd statements like this:

```java
if (set(”username”, ”unclebob”))…
```

The real solution is to separate the command from the query so that the ambiguity cannot occur.
```java
if (attributeExists(”username”)) {
    setAttribute(”username”, ”unclebob”);      
    …    
}
```

Prefer Exceptions to Returning Error Codes

Extract Try/Catch Blocks

...extract the bodies of the try and catch blocks out into functions of their own.

```java
public void delete(Page page) {
    try {
        deletePageAndAllReferences(page);
    } catch (Exception e) {
        logError(e);
    }
}
```

**Error Handling Is One Thing**

Functions should do one thing. Error handing is one thing. Thus, a function that handles errors should do nothing else. This implies (as in the example above) that if the keyword try exists in a function, it should be the very first word in the function and that there should be nothing after the catch/finally blocks.

When you use exceptions rather than error codes, then new exceptions are derivatives of the exception class. They can be added without forcing any recompilation or redeployment.
                
Don’t Repeat Yourself
                
Duplication may be the root of all evil in software.
                
**How Do You Write Functions Like This?**
                
When I write functions, they come out long and complicated. They have lots of indenting and nested loops. They have long argument lists. The names are arbitrary, and there is duplicated code. But I also have a suite of unit tests that cover every one of those clumsy lines of code. So then I massage and refine that code, splitting out functions, changing names, eliminating duplication. I shrink the methods and reorder them. Sometimes I break out whole classes, all the while keeping the tests passing.
                
In the end, I wind up with functions that follow the rules I’ve laid down in this chapter. I don’t write them that way to start. I don’t think anyone could.
                
Functions are the verbs of that language, and classes are the nouns.
                
The art of programming is, and has always been, the art of language design.
                
This chapter has been about the mechanics of writing functions well. If you follow the rules herein, your functions will be short, well named, and nicely organized. But never forget that your real goal is to tell the story of the system, and that the functions you write need to fit cleanly together into a clear and precise language to help you with that telling.