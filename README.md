# L'envol
A project PHP from scratch with Guzzle, League/Route, Bootstrap, Twig.
The purpose of this project is to learn League/Route and Guzzle which requests API.

## The origin of this project and the purpose

I began a internship where I need to developp a microservice which use an API. The technologies are these (Guzzle, League/route,Bootsrap for the view and twig). The API uses Oauth 2 so I learned about this and choose an API which use this to know how it really works.
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
You need to do some commands to have the possibility to run the website in your IDE :

`composer install`

To install what the program need, you find every what it needs in the composer.json

`php -S localhost:8000`

In order tu run the website locally you have to make this command, 8000 is an example port but you can choose an other

## How I used the technologies and difficulties I met


It was difficult to start because I never did a real project in pure PHP with technologies like Guzzle and League/Route. 

The beginning is to install packages I need with composer, a perfect managr for PHP, I never init a composer from 0 and add dependance by dependance.

I met difficulties to link the result of a Guzzle client in a template Twig, so I searched in the web how load and return a twig page. It's important to make the cache false in Twig beacause of development. We want to modify the page and refresh to see the result.

Also I learned how to use League/route in index.php in order to make the navbar and the link of pages.  

When I added pages and multiple controllers, I needed to register the IATA to know what the user entered and show it for example. I use session because it's a more secure than cookies and more simple with the storage. But it's important to delete the value of session['iata'] to enter a new when the user make a new request. Also the access_token had to be register.

Moreover, reformat the Response of the API was hard because of 2 things: 
* we have to decode the result (with json_decode($body, true)) 
* and to know the structure of the Response to filter what we want to show (like IATA...)

I wanted to manage the case of the expiration of the token so when it's expires I made a template to show the user the need of reconnect or a worse enter. I made a try catch with 2 status code :
- the error 400 because the user didn't give a good format of the query parameter, the IATA had to be given with 3 letters.
- other error, it's generally 401 because the access_token expired. So we need to reconnect.


I needed google and the doc of bootstrap to make a beautiful interface, it's very useful to use Twig and the different template to separate the sections like header and footer. It's front but important to give information to the user to make a request or what is the purpose of the website.

The biggest difficulty for me it was to make an useful website. The first version includes just the "Recherche" route where we enter a code IATA to have a result. But we don't know every IATA code of airport, so the user had to go to the link in order to know the IATA code of an airport. To make it useful, I wanted to add this feature : enter a name of a city and have the destinatons of it's airport. It was long to found an API which give me the IATA code. So long that I have to request 2 API's to have the IATA Code of an airport by a name of a city. One with the name of the city to know it's position (latitude and longitude), and an other one to have the IATA Code near to this place. 

## What feature we can add to the website

There is a thing I haven't done yet is to propose airports in a city and give the choice to the visitor to select one. Like New York or Paris where there are at least 2 airports. 
It's a feature that can be good to know the count of airport by city for example too.
