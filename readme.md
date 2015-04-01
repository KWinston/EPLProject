## EPL Kit booking

[![Total Downloads](/images/downloads.svg)](https://github.com/macewanCMPT395/irww/archive/master.zip)
[![Latest Stable Version](/images/stable.svg)](https://github.com/macewanCMPT395/irww/archive/master.zip)
[![License](https://poser.pugx.org/laravel/framework/license.svg)](http://opensource.org/licenses/MIT)

The EPL kit booking system is written on top of Laravel 4.2.17[Laravel website](http://laravel.com/docs) using mysql database.

## Installation
1. Retrieve EPL Kit managment software [![Latest Stable Version](https://poser.pugx.org/laravel/framework/v/stable.svg)](https://github.com/macewanCMPT395/irww/archive/master.zip)
2. Install Composer [![Latest Stable Version](https://poser.pugx.org/laravel/framework/v/stable.svg)](https://getcomposer.org/doc/00-intro.md)
3. Install / Configure MySql (see below)
4. Perform a composer install on EPL Kit Managment software and execute the 'composer install' command.
5. Perform a 'artisan migrate' to intalize and seed the database.
6. Configure 'app/config/database.php' with the details from above.
7. test setup with 'artisan serve'

## Configure MySql
You will need to install and configure MySql or other compatible sql database as per [Laravel's requirements](http://laravel-recipes.com/recipes/58/setting-up-the-mysql-database-driver).

EPL Kit Managment has been built to use a limited sql user account, for normal operations the sql users needs basic SELECT, INSERT, DELETE, UPDATE operations (see Laravel documentation for needed roles). Although during the migration process DDL(data definition language) roles will be needed to initialize the database (see Laravel documentation for needed roles).

The EPL_KIT_DB database will be created by the 'artisan migrate' command with the following tables.
- Booking - This table stores the bookings by user for a specific kit for a specific event
- BookingDetails - This table stores a list of users assosated with a booking.
- Branches - This stores details about the branches in the library system (see Going Live).
- KitTypes - This table stores the categories for all kits. Each kit belongs to one kit type
- Kits - This table stores the information about a specific kit, and it's location in the library system.
- KitContents - This table stores the contents of a kit and reference to any damaged or missing components.
- KitState - This tables stores the states that a kit can be in, static data for referential integrity.
- LogTypes - This tables stores the type of log messages that exist in the system, static data for referential integrity.
- Logs - This table records a history of all changes that occurs within the system.  No data retention policy has been defined for this table.
- Settings - This table stores details of various configuration settings needed to operate.
- users - This table stores the username, email, password for the users in the system (see going live!)

## Going Live

You want to take this system live? There are a couple areas where the system will need to be modified.
### Branches
The branches system is a example of data needed to define which branches kits can be transfered between. This area was left poorly defined as it is enisioned that this table will be replaced with a connection into the library branch database. The table was initialized with information downloaded from the EPL API data, replacing this data with access to the live database table behind the API information is desired.

The system does rely on there being a branch (ID 0) which is the IT depot for the system. This is the default location new kits will be created at.

### Users
The user table by default has two users ('user' is a administrator, 'user2' is a normal user) both which have the password 'user'. This table and all references to it are expected to be replaced with access into the EPL LDAP system. The basic admin screens for user management are primitive at best.
