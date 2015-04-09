Things to make sure you do for Laravel Heroku Deployment:
Note: project directory = irww in this case

Guide:

1. composer.json, make sure to add "ext-mbstring": "*" if its not there (Usually it is not here)
NOTE: Remember the , on the line previous to your added line.

ie.

	"require": {
		"laravel/framework": "4.2.*",
        "indatus/dispatcher": "1.4.*",
        "ext-mbstring": "*"
	},

Save composer.json


2. add Procfile to project directory and setup Heroku (Usually it is not here, spelling matters) 

Procfile contents:

web: vendor/bin/heroku-php-apache2 public

$ composer install    -> within in the project directory
$ composer update
$ heroku create
$ heroku config:set BUILDPACK_URL=https://github.com/heroku/heroku-buildpack-php
$ heroku addons:add cleardb        (for mysql)


3. Within /app/config/database.php, after <?php on the next line, Add to file the following lines:

$url = parse_url(getenv("CLEARDB_DATABASE_URL"));

$host = $url["host"];
$username = $url["user"];
$password = $url["pass"];
$database = substr($url["path"], 1);


4. Modify your mysql connection string, mainly the four variables: host, database, username, password
so that it looks like this:

		'mysql' => array(
			'driver'    => 'mysql',
			'host'      => $host,
			'database'  => $database,
			'username'  => $username,
			'password'  => $password,
			'charset'   => 'utf8',
			'collation' => 'utf8_unicode_ci',
			'prefix'    => '',
		),

Then save and close the file.

Note: We have 'port' set to 8889 for our offline, the default port of 3306 can be used for Heroku
Remove the port line when deploying to Heroku


5. Commit the changes so we can push to heroku master (make sure your heroku create worked)

$ git add .
$ git commit -m "Set up the heroku creds and update default route to cleardb"
$ git push heroku master

6. If you would like to run migrations, within the project directory:

$ heroku run php /app/artisan migrate

7. If you would like to connect to the DB, use MySQL WorkBench or another client

$ heroku config

Copy the CLEARDB_DATABASE_URL contents
ie., mysql://iamagiraffe:passwordmammal@ec2-117-25-170-214.compute-1.amazonaws.com/db982398?reconnect=true

In MySQL WorkBench, right click inside the connections, and click Add Connection(s) from clipboard.
Edit username to be iamagiraffe
Edit password to be passwordmammal
Edit hostname to be ec2-117-21-174-214.compute-1.amazonaws.com (you will likely have ?reconnect=true attached, remove it)
Edit default schema to be db982398

Then, Voila! your connection should be ready to go.