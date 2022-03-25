# Paylatte

Paylatte is a BuyNow PayLater (BNPL) website which is still Under Development By Got-Your-Backs Team from mPokket

## Description

An in-depth  use of our website is on behalf of our User/Customer we will pay to Vendor/Merchant for the particular product he wants to buy from the vendor and recollect the money from the User after a month.

## Getting Started

### Dependencies

 Dependencies of our project will be 
   * Linux 18.04 and greater
   * PHP Version 7.4 and greater
   * Laravel 8
   * CockroachDb
   * PostMan

### Installing

Download the Composer from the package (once developement of app is done).
* Modifications needed to be made to files.
* After Running the composer package  the vendor file will auto generate the files 
* Based on the Auto-Generated file create a new file .env from .env example file
* After creation of .env file update the any connections like database,Mailer etc  for your project.

### Executing program

* How to run the program
* Step-by-step bullets
* Start The Cluster in cockroachDB
* Start the first Node
```
cockroach start --certs-dir=certs --store=node1 --listen-addr=localhost:26257 --http-addr=localhost:8080 --join=localhost:26257,localhost:26258,localhost:26259 --background
```
* Start  the Second Node
```
cockroach start --certs-dir=certs --store=node2 --listen-addr=localhost:26258 --http-addr=localhost:8081 --join=localhost:26257,localhost:26258,localhost:26259 --background
```
* Start the Third Node
```
cockroach start --certs-dir=certs --store=node3 --listen-addr=localhost:26259 --http-addr=localhost:8082 --join=localhost:26257,localhost:26258,localhost:26259 --background
```
* Intialize the Cluster
```
cockroach init --certs-dir=certs --host=localhost:26257
```
* Start your Built-In SQL Client
```
cockroach sql --certs-dir=certs --host=localhost:26257
```
* Check Your Controllers if You Want To Make any Updates
* Start the Server
```
php artisan serve
```
* Verify Your Routes through Postman.
## Help

Our advise for common problems or issues.
```
Follow Basic Documentation of 
 * Larvel
 * Cockroach db
 * PostMan
```

## Authors

Important Contributors are
 * Kamisetti Bharat Rajesh (https://github.com/bharatgotyourbacks)
 * Divya Pitti(https://github.com/Divyapitti)
 * Hanvesh Pinapothu(https://github.com/Hanvesh)
 * Nikhil Parakh(https://github.com/zindaadmi)

## Version History

    * Initial Release

## License

This project is licensed under the [Got-Your-Backs] License - see the LICENSE.md file for details


