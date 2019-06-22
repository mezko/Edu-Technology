<!DOCTYPE html>
<head>
  <title>Pusher Test</title>
  <script src="https://js.pusher.com/4.4/pusher.min.js"></script>
  <script>

    // Enable pusher logging - don't include this in production
    Pusher.logToConsole = true;

    var pusher = new Pusher('11dd1afd9c42783888a3', {
      cluster: 'mt1',
      forceTLS: true
    });

    var channel = pusher.subscribe('notif');
    channel.bind('mynoti', function(data) {
      alert(JSON.stringify(data));
    // this->data=data->text;

    });
  </script>
</head>
<body>
  <h1>Pusher Test</h1>
  <p>
      @{{data}}
    Try publishing an event to channel <code>my-channel</code>
    with event name <code>my-event</code>.
  </p>
</body>