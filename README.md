# COEN174Project


## Copying files

From remote login

1. Copy files from https://github.com/HaoboZ/COEN174Project
2. login to SCU account at linux.scudc.scu.edu
3. run `mkdir /webpages/**username**/COEN174`
4. run `make copy username=**username**`
5. run `cd /webpages/**username**/COEN174`
6. run `make activate`

From DC computer

1. run `mkdir /webpages/**username**/COEN174`
2. Copy files from https://github.com/HaoboZ/COEN174Project to COEN174 folder
3. run `cd /webpages/**username**/COEN174`
4. run `make activate`

## Creating SQL Tables
Needs to run from COEN174 folder
1. run `setup oracle`
2. run `sqlplus **username**@db11g`
3. login
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
    - [x] view full event reports
    - [x] verify alumni
* fixing up forms - Alfredo
    - [x] add events
    - [x] edit events (retrieve date)
    - [x] php security, check formats
    - [x] grad year of alumni
* styling pages - Alfredo
    - [x] time
    - [ ] overall style of website