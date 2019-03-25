# Cloudfest Hackathon 2019 - Intel Machine Learning - UI

## About

This is an example application for showing the results of the OISP Machine Learning project from Cloudfest Hackathon 2019.

## Architecture Overview

The core of the results viewing app is a <a href="https://www.laravel.com">Laravel 5.8</a> application. It has a websocket server compatible with pusher for dynamic updating of the web interface.

The incoming data is pushed over a REST API from the KubeFlow workflow. This contains the inferred data (emotion) and a base64 encoded representation of the image. This image is saved to an S3 compatible datastore. In this case, minio. The data is persisted into a MariaDB instance and an message emitted on a redis queue for a queue worker to pick up for the next step.

The queue worker picks up the message telling it there's a new a result for further processing and it broadcasts information about the result on a pub/sub websocket server. You could optionally extend the project at this point to also trigger another REST API or talk back into OISP to control a device.

The client application is running on the user's web browser and is connected to the websocket. This recieves the updates from the websocket and updates the UI to display the image and the emotion.

![Diagram](https://raw.githubusercontent.com/mintopia/cfhack19-intel-results/master/src/public/img/diagram.png)

## Deployment

The application is deployed to a Kubernetes cluster. Setting up redis, minio and mariadb is out of scope for this, but they can all be configured using Helm. The GitHub project for this application includes all the k8s objects required. These can be deployed using kubectl.

## Credits

This application was developed at the CloudFest 2019 Hackathon by [Jessica Smith](https://github.com/mintopia)

## License

MIT License

Copyright (c) 2019 Jessica Smith

Permission is hereby granted, free of charge, to any person obtaining a copy
of this software and associated documentation files (the "Software"), to deal
in the Software without restriction, including without limitation the rights
to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
copies of the Software, and to permit persons to whom the Software is
furnished to do so, subject to the following conditions:

The above copyright notice and this permission notice shall be included in all
copies or substantial portions of the Software.

THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN THE
SOFTWARE.
