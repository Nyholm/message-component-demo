# Message component demo

This demo is to demonstrate Samuel Roze's implementation of a Message Component. 

## Try the demo

Clone the repo, 
```
composer install
nano .env

# Test syncronous commands with
bin/console app:fetch-user

# Test async commands with
bin/console app:create-number

# Start async worker with
bin/console message:consume enqueue_bridge.receiver -vvv

# Check out the profiler page
bin/console server:run
```

The only configuration we are doing is in `config/packages/messenger.yaml` where we define that some messages should
be sent asynchronous. 

## Highlights

- The application code is located in `src/Message`.
- The message handlers are configured with "autowire" and "autoconfigure" in `services.yaml`

As you may see, the queue/asynchronous part of this application is just a implementation 
detail. It is something defined in configuration what messages that should go on
the queue. Nothing in your application code will be changed when we go async.  

### Message bus

A message bus supports middleware. Which means we can make sure we do all sorts 
of awesome things:

- Enforce that all changes are in one Doctrine transaction
- Validate all messages with Symfony validator to make sure only valid messages 
  gets to the `Handler`. 
- Logging and profiling


#### Default bus

- Allows zero or more handlers
- Supports both sync and async
- Return values are optional

#### Command bus

- Exactly one handler required
- Supports both sync and async
- No return values from handlers

#### Event bus

- Allows zero or more handlers
- Supports both sync and async
- No return values from handlers

#### Query bus

- Exactly one handler required
- Supports only sync
- Return values required
