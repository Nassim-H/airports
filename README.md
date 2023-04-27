# Airports
A project PHP from scratch with Guzzle, League/Route, Bootstrap, Twig.
The purpose of this project is to learn League/Route and Guzzle which requests API.

## The origin of this project what it's utility

I began a internship where I need to developp e microservice which use an API. The technologies are these (Guzzle, League/route,Bootsrap for the view and twig). The API uses Oauth 2 so I learned about this and choose an API which use this too.
The utility of this website is to know destinations of an airport by giving the IATA code of the airport.

## Documentation 
I began the internship with reading documentations about technologies 
- https://oauth.net/2/
- https://www.rfc-editor.org/rfc/rfc6749
- https://www.rfc-editor.org/rfc/rfc7231
- https://route.thephpleague.com/5.x/
- https://docs.guzzlephp.org/en/stable/
- https://getcomposer.org

## Installation
You need to do some commands to have the possibility to run the website :

`composer install`

To install what the program need, you find every what it needs in the composer.json

`php -S localhost:8000`

In order tu run the website locally you have to make this command, 8000 is an example port but you can choose an other
