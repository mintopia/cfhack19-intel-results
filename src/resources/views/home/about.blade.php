@extends('application.layout')
@section('content')
    <h1>About</h1>
    <p>
        This is an example application for showing the results of the OISP Machine Learning project from Cloudfest Hackathon 2019.
    </p>

    <h2>Architecture Overview</h2>

    <p>
        The core of the results viewing app is a <a href="https://www.laravel.com">Laravel 5.8</a> application. It has a websocket
        server compatible with pusher for dynamic updating of the web interface.
    </p>

    <p>
        The incoming data is pushed over a REST API from the KubeFlow workflow. This contains the inferred data (emotion) and a base64
        encoded representation of the image. This image is saved to an S3 compatible datastore. In this case, minio. The data is persisted
        into a MariaDB instance and an message emitted on a redis queue for a queue worker to pick up for the next step.
    </p>

    <p>
        The queue worker picks up the message telling it there's a new a result for further processing and it broadcasts information
        about the result on a pub/sub websocket server. You could optionally extend the project at this point to also trigger another REST
        API or talk back into OISP to control a device.
    </p>
    <p>
        The client application is running on the user's web browser and is connected to the websocket. This recieves the updates from
        the websocket and updates the UI to display the image and the emotion.
    </p>

    <img src="/img/diagram.png" class="align-center" />

    <h2>Deployment</h2>

    <p>
        The application is deployed to a Kubernetes cluster. Setting up redis, minio and mariadb is out of scope for this, but they can all
        be configured using Helm. The GitHub project for this application includes all the k8s objects required. These can be deployed using kubectl.
    </p>
@endsection
