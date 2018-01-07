# Message component demo

This demo is to demonstrate Samuel Roze's implementation of a Message Component. 

## Try the demo

Clone the repo, 
```
composer install
```

## Things to be aware of

### Message bus

A message bus supports middlewares. Which means we can make sure we do all sorts 
of awesome things:

- Enforce that all changes are in one Doctrine transaction
- Validate all messages with Symfony validator to make sure only valid messages 
  gets to the `Handler`. 
- Logging and profiling

### Command handlers



## Future work

Different type of handlers
- Event, commands, query.
- Differnt rules and constraints

 
