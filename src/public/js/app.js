var App = {
    host: null,
    port: null,
    appId: null,
    channel: null,
    pusher: null,
    prefix: null,
    forceTLS: false,
    key: null,

    init: function () {
        jQuery(document).ready(function () {
            App.ready();
        })
    },

    ready: function () {
        App.connectToPusher();
    },

    connectToPusher: function()
    {
        this.pusher = new Pusher(this.key, {
            wsHost: this.host,
            wsPort: this.port,
            wssPort: this.port,
            disableStats: true,
            authEndpoint: '/laravel-websockets/auth',
            auth: {
                headers: {
                    'X-App-ID': this.appId
                }
            },
            forceTLS: this.forceTLS
        });
        this.pusher.subscribe(this.channel).bind('App\\Events\\ResultSubmittedEvent', function (data) {
            App.updateFromJSON(data);
        });
    },

    updateFromJSON: function(json)
    {
        console.log(json);
    }
};
