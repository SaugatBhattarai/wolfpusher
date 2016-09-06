
self.addEventListener('install', function(event) {
  self.skipWaiting();
  console.log('Installed', event);
});

self.addEventListener('activate', function(event) {
  console.log('Activated', event);
});

self.addEventListener('push', function(event) {
  console.log('This is test push. Push notification');
});	

// self.addEventListener('fetch',function(event){
//   // console.log(event.request);
//   console.log(event.request.url);
//   console.log(event.request.method);
//   console.log(event.request.headers);
//   // event.responseWith(new response("Hello World Saugat His is Page hijacks"));
// });

self.addEventListener('message', function(event){
    console.log("SW Received Message: " + event.data);
    event.ports[0].postMessage("SW Says 'Hello back!'");
});


function send_message_to_client(client, msg){
    return new Promise(function(resolve, reject){
        var messageChannel = new MessageChannel();

        messageChannel.port1.onmessage = function(event){
            if(event.data.error){
                reject(event.data.error);
            }else{
                resolve(event.data);
            }
        };
        client.postMessage("SW Says: '"+msg+"'", [messageChannel.port2]);
    });
}

function send_message_to_specific_client(msg){
  clients.matchAll().then(function(clients) {
    // console.log(clients);
    var i=0;
    clients.forEach(client => {      
      if(i==0){
        console.log('sent '+i);
        send_message_to_client(client, msg).then(m => console.log("SW Received Message: "+m));
      }
        i++;
    })
  });
}

function send_message_to_specific_link(msg){
clients.matchAll().then(function(clients) {
  var messageChannel = new MessageChannel();
    for(var i = 0 ; i < clients.length ; i++) {
      if(clients[i].url === 'http://localhost/wolfpusher/client2.html') {
        send_message_to_client(clients[i], msg).then(m => console.log("SW Received Message: "+m)); 
      }
    }
  });
}

function send_message_to_specific_given_link(client,msg){
clients.matchAll().then(function(clients) {
  var messageChannel = new MessageChannel();
    for(var i = 0 ; i < clients.length ; i++) {
      if(clients[i].url === "http://localhost/wolfpusher/"+client){
        send_message_to_client(clients[i], msg).then(m => console.log("SW Received Message: "+m));
      }
    }
  });
}

function send_message_to_all_clients(msg){
    clients.matchAll().then(clients => {
      clients.forEach(client => {
          send_message_to_client(client, msg).then(m => console.log("SW Received Message: "+m));
      })
    })
}

