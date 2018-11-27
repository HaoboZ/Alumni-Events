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

## TODO

* events page - Haobo
    - [x] admin sees all events
    - [x] alumni events need processing
    - [x] filter
* single events page - Haobo
    - [x] add checklist next to alumni participants to verify them
    - [x] display event
    - [x] check in event
    - [x] approve alumni created ones
* calendar - Haobo
    - [x] display
* engine - Haobo
    - [x] login
* admin controls - Alfredo
    - [x] post event
    - [ ] view full event reports
    - [x] verify alumni
* fixing up forms - Alfredo
    - [x] add events
    - [ ] edit events (retrieve date)
    - [ ] php security, check  formats
    - [x] grad year of alumni
* styling pages - Alfredo
    - [ ] time
    - [ ] overall style of website