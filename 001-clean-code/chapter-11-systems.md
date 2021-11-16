# Systems

- It is a myth that we can get systems “right the first time.” Instead, we should implement only today’s stories, then refactor and expand the system to implement new stories tomorrow. This is the essence of iterative and incremental agility. Test-driven development, refactoring, and the clean code they produce make this work at the code level.

- Optimize Decision Making
    - We all know it is best to give responsibilities to the most qualified persons. We often forget that it is also best to postpone decisions until the last possible moment.
                

- Use Standards Wisely, When They Add Demonstrable Value
                

- Systems Need Domain-Specific Languages
    - Domain-Specific Languages (DSLs), which are separate, small scripting languages or APIs in standard languages that permit code to be written so that it reads like a structured form of prose that a domain expert might write.
                
- Conclusion 
    - Systems must be clean too. An invasive architecture overwhelms the domain logic and impacts agility. When the domain logic is obscured, quality suffers because bugs find it easier to hide and stories become harder to implement. If agility is compromised, productivity suffers and the benefits of TDD are lost. At all levels of abstraction, the intent should be clear. This will only happen if you write POJOs and you use aspect-like mechanisms to incorporate other implementation concerns noninvasively. Whether you are designing systems or individual modules, never forget to use the simplest thing that can possibly work.