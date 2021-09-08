# Chapter 6: Objects and Data Structures

**Data Abstraction**

- Hiding implementation is not just a matter of putting a layer of functions between the variables. Hiding implementation is about abstractions! A class does not simply push its variables out through getters and setters. Rather it exposes abstract interfaces that allow its users to manipulate the essence of the data, without having to know its implementation.

- Serious thought needs to be put into the best way to represent the data that an object contains.

- Objects hide their data behind abstractions and expose functions that operate on that data. Data structure expose their data and have no meaningful functions.

- Procedural code (code using data structures) makes it easy to add new functions without changing the existing data structures. OO code, on the other hand, makes it easy to add new classes without changing existing functions.

- Mature programmers know that the idea that everything is an object is a myth. Sometimes you really do want simple data structures with procedures operating on them.

- The Law of Demeter There is a well-known heuristic called the Law of Demeter2 that says a module should not know about the innards of the objects it manipulates.
More precisely, the Law of Demeter says that a method f of a class C should only call the methods of these:
    - C 
    - An object created by f 
    - An object passed as an argument to f 
    - An object held in an instance variable of C

- The method should not invoke methods on objects that are returned by any of the allowed functions. In other words, talk to friends, not to strangers. The following code appears to violate the Law of Demeter (among other things) because it calls the getScratchDir() function on the return value of getOptions() and then calls getAbsolutePath() on the return value of getScratchDir().    

    ```java
    final String outputDir = ctxt.getOptions().getScratchDir().getAbsolutePath(); 
    ```

- Train Wrecks - This kind of code is often called a train wreck because it look like a bunch of coupled train cars. Chains of calls like this are generally considered to be sloppy style and should be avoided [G36]. It is usually best to split them up as follows:    

    ```java
    Options opts = ctxt.getOptions();    
    File scratchDir = opts.getScratchDir();    
    final String outputDir = scratchDir.getAbsolutePath();
    ```

- On the other hand, if ctxt, Options, and ScratchDir are just data structures with no behavior, then they naturally expose their internal structure, and so Demeter does not apply. The use of accessor functions confuses the issue. If the code had been written as follows, then we probably wouldn’t be asking about Demeter violations. 
    ```java
    final String outputDir = ctxt.options.scratchDir.absolutePath;
    ```

- If ctxt is an object, we should be telling it to do something; we should not be asking it about its internals.

    ```java
    BufferedOutputStream bos = ctxt.createScratchFileStream(classFileName); 
    ```

- That seems like a reasonable thing for an object to do! This allows ctxt to hide its internals and prevents the current function from having to violate the Law of Demeter by navigating through objects it shouldn’t know about.

**Data Transfer Objects**

- a class with public variables and no functions. This is sometimes called a data transfer object, or DTO. DTOs are very useful structures, especially when communicating with databases or parsing messages from sockets, and so on.

- Active Record Active Records are special forms of DTOs. 

- They are data structures with public (or bean-accessed) variables; but they typically have navigational methods like save and find. Typically these Active Records are direct translations from database tables, or other data sources. 

- Unfortunately we often find that developers try to treat these data structures as though they were objects by putting business rule methods in them. This is awkward because it creates a hybrid between a data structure and an object. 

- The solution, of course, is to treat the Active Record as a data structure and to create separate objects that contain the business rules and that hide their internal data (which are probably just instances of the Active Record).

**Conclusion** 

- Objects expose behavior and hide data. 

- This makes it easy to add new kinds of objects without changing existing behaviors. It also makes it hard to add new behaviors to existing objects. 

- Data structures expose data and have no significant behavior. 

- This makes it easy to add new behaviors to existing data structures but makes it hard to add new data structures to existing functions.


