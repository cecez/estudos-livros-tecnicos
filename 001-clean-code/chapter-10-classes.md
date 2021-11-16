# Classes

Class Organization

Encapsulation
                

- We like to keep our variables and utility functions private, but we’re not fanatic about it. Sometimes we need to make a variable or utility function protected so that it can be accessed by a test. For us, tests rule.
                

- Classes Should Be Small!            
    - The first rule of classes is that they should be small. The second rule of classes is that they should be smaller than that.
                

- With functions we measured size by counting physical lines. With classes we use a different measure. We count responsibilities.
                

- The name of a class should describe what responsibilities it fulfills. In fact, naming is probably the first way of helping determine class size. If we cannot derive a concise name for a class, then it’s likely too large.
                

- The Single Responsibility Principle
    - The Single Responsibility Principle (SRP) states that a class or module should have one, and only one, reason to change. This principle gives us both a definition of responsibility, and a guidelines for class size. Classes should have one responsibility — one reason to change.
    - Trying to identify responsibilities (reasons to change) often helps us recognize and create better abstractions in our code.
    - SRP is one of the more important concept in OO design. It’s also one of the simpler concepts to understand and adhere to. Yet oddly, SRP is often the most abused class design principle. We regularly encounter classes that do far too many things. Why? Getting software to work and making software clean are two very different activities. Most of us have limited room in our heads, so we focus on getting our code to work more than organization and cleanliness. This is wholly appropriate. Maintaining a separation of concerns is just as important in our programming activities as it is in our programs.
    
- The problem is that too many of us think that we are done once the program works. We fail to switch to the other concern of organization and cleanliness. We move on to the next problem rather than going back and breaking the overstuffed classes into decoupled units with single responsibilities.
                

- We want our systems to be composed of many small classes, not a few large ones.
                

- Each small class encapsulates a single responsibility,
                

- Cohesion Classes should have a small number of instance variables. Each of the methods of a class should manipulate one or more of those variables. In general the more variables a method manipulates the more cohesive that method is to its class. A class in which each variable is used by each method is maximally cohesive.
                

- Maintaining Cohesion Results in Many Small Classes
                

- When classes lose cohesion, split them!
                

- So breaking a large function into many smaller functions often gives us the opportunity to split several smaller classes out as well. This gives our program a much better organization and a more transparent structure.
                

- This program, written as a single function, is a mess. It has a deeply indented structure, a plethora of odd variables, and a tightly coupled structure. At the very least, the one big function should be split up into a few smaller functions.
                

- The first thing you might notice is that the program got a lot longer. It went from a little over one page to nearly three pages in length. There are several reasons for this growth. First, the refactored program uses longer, more descriptive variable names. Second, the refactored program uses function and class declarations as a way to add commentary to the code. Third, we used whitespace and formatting techniques to keep the program readable.
                

- The change was made by writing a test suite that verified the precise behavior of the first program. Then a myriad of tiny little changes were made, one at a time. After each change the program was executed to ensure that the behavior had not changed. One tiny step after another, the first program was cleaned up and transformed into the second.
                

- Organizing for Change
                

- When the time comes for the Sql class to support an update statement, we’ll have to “open up” this class to make modifications. The problem with opening a class is that it introduces risk.
                

- Any modifications to the class have the potential of breaking other code in the class. It must be fully retested.

Listing 10-9 
A class that must be opened for change 
```java
public class Sql {
    public Sql(String table, Column[] columns)
    public String create() 
    public String insert(Object[] fields)       
    public String selectAll()       
    public String findByKey(String keyColumn, String keyValue)
    public String select(Column column, String pattern)
    public String select(Criteria criteria)
    public String preparedInsert()
    private String columnList(Column[] columns)
```

- Private method behavior that applies only to a small subset of a class can be a useful heuristic for spotting potential areas for improvement.

- What if we considered a solution like that in Listing 10-10? Each public interface method defined in the previous Sql from Listing 10-9 is refactored out to its own derivative of the Sql class. Note that the private methods, such as valuesList, move directly where they are needed. The common private behavior is isolated to a pair of utility classes, Where and ColumnList.

```java

// Listing 10-10 A set of closed classes

abstract public class Sql {
    public Sql(String table, Column[] columns)       
    abstract public String generate();    
}    

public class CreateSql extends Sql {       
    public CreateSql(String table, Column[] columns)       
    @Override public String generate()    
}    

public class SelectSql extends Sql {       
    public SelectSql(String table, Column[] columns)       
    @Override public String generate()    
}    

public class InsertSql extends Sql {       
    public InsertSql(String table, Column[] columns, Object[] fields) @Override public String generate()       
    private String valuesList(Object[] fields, final Column[] columns)    
}    

public class SelectWithCriteriaSql extends Sql {       
    public SelectWithCriteriaSql(String table, Column[] columns, Criteria criteria)
    @Override public String generate()    
}    

public class SelectWithMatchSql extends Sql {       
    public SelectWithMatchSql(String table, Column[] columns, Column column, String pattern)
    @Override public String generate()    
}    

public class FindByKeySql extends Sql {
    public FindByKeySql(String table, Column[] columns, String keyColumn, String keyValue)
    @Override public String generate()    
}    

public class PreparedInsertSql extends Sql {       
    public PreparedInsertSql(String table, Column[] columns)
    @Override public String generate() {       
        private String placeholderList(Column[] ...


```

- Equally important, when it’s time to add the update statements, none of the existing classes need change! We code the logic to build update statements in a new subclass of Sql named UpdateSql. No other code in the system will break because of this change.

- Our restructured Sql logic represents the best of all worlds. It supports the SRP. It also supports another key OO class design principle known as the Open-Closed Principle, or OCP:4 Classes should be open for extension but closed for modification. Our restructured Sql class is open to allow new functionality via subclassing, but we can make this change while keeping every other class closed. We simply drop our UpdateSql class in place.
                

- We want to structure our systems so that we muck with as little as possible when we update them with new or changed features. In an ideal system, we incorporate new features by extending the system, not by making modifications to existing code.
                

- Isolating from Change Needs will change, therefore code will change. We learned in OO 101 that there are concrete classes, which contain implementation details (code), and abstract classes, which represent concepts only. A client class depending upon concrete details is at risk when those details change. We can introduce interfaces and abstract classes to help isolate the impact of those details.
                

- design principle known as the Dependency Inversion Principle (DIP).5 In essence, the DIP says that our classes should depend upon abstractions, not on concrete details.