# Rental Survey Docker project
A PHP based application to survey about the rental places available based on location which utilizes Docker container concept.

TECHNOLOGIES USED :
1. PHP 
2. Javascript
3. HTML
4. CSS
5. Bootstrap
6. Docker
 
REQUIREMENTS : 

1. docker
2. docker-compose

------------------------------------------
HOW TO RUN THIS PROJECT 
------------------------------------------

Note: Before starting the Project first stop and disable the apache and mysql services of system.

1. Pull the project from GitHub :
```bash
$ git clone https://github.com/WSMathias/RentalSurveyDocker.git
```
2. Change the directory to RentalSurveyDocker :
```bash
$ cd RentalSurveyDocker/
```
3. a) build the container for the first time using:
```bash
$ docker-compose up --build
```
3. b) from next time onwards start the container using:
```bash
$ docker-compose up 
```
4. Run the following script to setup default database :
```bash
$ ./run.sh
```
5. Go to browser and run the URL : http://localhost

6. To stop the application :
```bash
 $ docker-compose down
 ```
------------------------------------------
HOW TO RUN THE TESTING
------------------------------------------
1. To do the testing :
```bash
$ php codecept.phar run acceptance --steps
```
___________________________________________
EXPECTED OUTPUT
___________________________________________


1. Home page index.php :
	This page contains a search box to search for available rental places based on location.
	Also contains advanced option to filter the search based on area,lease period and rent.	
2. Survey result page :
	To display the result based on search query in home page.
3. Survey Entry page :
	To enter the places details based on area,location,rent,lease period.
4. Get Statistics page :
	Displays all the statistics based on the datas available in the database.

