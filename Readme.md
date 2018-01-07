# Message component demo

This demo is to demonstrate Samuel Roze's implementation of a Message Component. 

## Try the demo

Clone the repo, 
```
composer install
nano .env

# Test syncronous commands with
sf app:fetch-user

# Test async commands with
sf app:create-number

# Start async worker with
bin/console message:consume enqueue_bridge.receiver
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

### Message bus

A message bus supports middlewares. Which means we can make sure we do all sorts 
of awesome things:

- Enforce that all changes are in one Doctrine transaction
- Validate all messages with Symfony validator to make sure only valid messages 
  gets to the `Handler`. 
- Logging and profiling


## Future work

The message bus implementation is super flexible. If you configure the message 
bus with different types of middlewares you may have different types of busses. 

#### Default bus

- Allows zero or more handlers
- Supports both sync and async
- Return values are allowed

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
