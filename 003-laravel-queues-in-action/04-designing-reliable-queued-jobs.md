# Designing reliable queued jobs
- Making jobs self-contained: have everything they need to run, without relying on any external system state.
- Making jobs simple: 
  - job lifecycle (serialized -> encoded -> stored -> transferred over the network -> converted back -> executed). 
  - complex job -> lot of resources consumed
  - use simple datatypes
- Making jobs light: job payload as light as posible.
- Making jobs idempotent: run several times without any negative side effects.
- Making jobs parallelizable: avoid race conditions (use cache locks, funneling)