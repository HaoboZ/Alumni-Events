# COEN174Project


## Copying files

1. create folder `COEN174` in /webpages/\*\*username\*\*
2. copy files using `make copy_**username**` (make sure login username is correct)
3. login to SCU account at linux.scudc.scu.edu
4. navigate to /webpages/\*\*username\*\*/COEN174
5. run `make activate`

## Creating SQL Tables

1. run `setup oracle`
2. run `sqlplus hzhang@db11g`
3. password is `thisisasecurepassword`
4. run `@database/database`

## Website

students.engr.scu.edu/~\*\*username\*\*/COEN174

## Design

* admin
	* main
	    * calendar
	    * pending events
	* events
	    * list
	* single
	    * delete
	    * modify
	    * view participants
* user
	* main
	    * calendar
	* events
	    * list
	* single
	    * participate
