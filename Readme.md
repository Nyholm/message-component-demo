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

What we install is the new component ([PR branch](https://github.com/symfony/symfony/pull/24411)) 
and a library that sends messages to RabbitMQ. Any library will do, we just need a small bridge. 
In this demo we use `enqueue/enqueue` with `sroze/enqueue-bridge`. 

The only configuration we are doing is in `framwork.yaml` where we define that some messages should
be sent asynchronous. 

## Highlights

- The application code is located in `src/Message`.
- The message handlers are configured in `services.yaml` and with `Symfony\Component\Message\DependencyInjection\MessagePass`
- The Sender and Receiver for queues in `Sam\Symfony\Bridge\EnqueueMessage`

As you may see, the queue/asynchronous part of this application is just a implementation 
detail. It is something defined in configuration what messages that should go on
the queue. Nothing in your application code will be changed when we go async.  

### Message bus

A message bus supports middlewares. Which means we can make sure we do all sorts 
of awesome things:

- Enforce that all changes are in one Doctrine transaction
- Validate all messages with Symfony validator to make sure only valid messages 
  gets to the `Handler`. 
- Logging and profiling


## Future work

The message bus implementation is super flexible. The different busses below will
have the exact same implementation but different service configuration. An application
user will need the different busses to help to enforce design patterns. 

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

 
### Configuration

We could also autowire the configuration for asynchronous messages. 

### Fails and retries

When somethings goes wrong we want to put the messages on a retry queue to attempt 
the same message again later. This could be achieved with a new middleware that 
catches exceptions from the handler. When an exception is thrown we use an other
producer service that publish the message on an error queue. 

It is out of scope for the message component to move back messages. That should be
handled by the AMQP library or manually. When messages are moved back to the "worker
queue" they are treated exactly the same as any messages. 

A AMQP library may add a fingerprint on messages to make sure they are retried autmatically
5(?) times with different time intervals etc etc. But that is, again, out of scope of
the message component. 