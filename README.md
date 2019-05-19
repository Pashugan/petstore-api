## Pet Store API

### Development mode

1. Run Docker Compose from the root directory
~~~
$ docker-compose up -d --build
~~~

### "Production" mode

1. Build the store image
~~~
$ docker build -t petstore/store:latest store
~~~
2. Run Docker Compose from the root directory
~~~
$ docker-compose -f docker-compose.yml -f docker-compose.prod.yml up -d
~~~

### Logs

1. You might want to open the logs in a separate terminal
~~~
$ docker-compose logs -f
~~~

### Testing

1. Wait a few seconds to let MySQL database initialize

2. Execute the following commands
~~~
# Get the prepopulated order
$ curl 'http://localhost/v2/store/order/1'

# Ensure there is no such an order
$ curl 'http://localhost/v2/store/order/2'

# Create a new order
$ curl 'http://localhost/v2/store/order' -H "Content-Type: application/json" -d "{ \"id\": 0, \"petId\": 1, \"quantity\": 1, \"shipDate\": \"2019-05-20\", \"status\": \"placed\", \"complete\": false}"

# Get the order's data
$ curl 'http://localhost/v2/store/order/2'

# Delete the order
$ curl -X DELETE 'http://localhost/v2/store/order/2'

# No traces of the order
$ curl 'http://localhost/v2/store/order/2'

# And you can't kill it twice
$ curl -X DELETE 'http://localhost/v2/store/order/2'

# This depends on the Pets microservice
$ curl 'http://localhost/v2/store/inventory'
~~~

### Shut everything down

1. Stop Docker Compose
~~~
$ docker-compose down -v
~~~
