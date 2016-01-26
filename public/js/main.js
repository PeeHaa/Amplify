(function () {
    'use strict';

    var clientCounter = document.querySelector('.clients');
    var yourCounter   = document.querySelector('.yours');
    var globalCounter = document.querySelector('.global');

    var local = 0;

    var connection = new WebSocket('ws://localhost:8081/ws');

    connection.addEventListener('message', function(data) {
        var parsedData = JSON.parse(data.data);

        clientCounter.textContent = parsedData.clients;
        globalCounter.textContent = parsedData.global;
    });

    document.querySelector('button').addEventListener('click', function() {
        local++;

        yourCounter.textContent = local;

        connection.send(JSON.stringify({click: true}));
    });
}());
