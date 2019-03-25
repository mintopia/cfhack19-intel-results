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
        let emotion = 'Unknown';
        let date = moment(json.data.created_at).format('YYYY-MMM-DD HH:mm:ss');
        if (json.data.emotion) {
            emotion = json.data.emotion
        }
        let html = '<div class="text-center">';
        html += '<h1 class="mt-1 mb-5">' + emotion + '</h1>';
        html += '<img src="' + json.image_url + '" class="rounded-sm"/>';
        html += '</div>';
        html += '<h3 class="mt-5">Data</h3>';
        html += '<table class="table table-striped">';
        html += '<thead class="thead-dark"><tr><th scope="col">ID</th><th scope="col">Emotion</th><th scope="col">Date</th></tr></thead>';
        html += '<tbody><tr><td>';
        html += '<a href="/results/' + json.id + '">' + json.id + '</a>';
        html += '</td><td>' + emotion + '</td><td>' + date + '</td></tr></tbody></table>';

        jQuery('#results').html(html);
    }
};
