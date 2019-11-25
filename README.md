# Workforce date calculator

Code owner: Zoltan Nagy <nzolthu@gmail.com>
### Acceptance Criteria:
- A name can be entered.
- My date of birth can be entered using a date picker.
- My age in years days and hours is displayed.
- Name and age of previous submissions is displayed.

[Calculate | Years | Days | Hours] - from a given date
Calculate: http(s)://localhost/oldhours
- 
Format: YYYY-MM-DD HH:MM or YYYY-MM-DD (defaulting to 00:00 if no hours and minutes provided)
Name must be min 1 - max 64 caracters 
### Asumption:
- No persistent data need to be stored - Session is used to store may 100 latest requests
    - stores maximum 100 latest dates in Session (deleting the oldest one and adding the new to the top of the list)

### Properties:
>- Main Url: http(s)://localhost (when called resets the SESSION / delete stored dates) - contains link to Date calculator (http://localhost/oldhours)
>- Date calculator url is [GET] http://localhost/oldhours
>- generates CSRF token for security- the page can be reloaded withouth loosing stored data
>- the for is posted to the same (http://localhost/oldhours) url [POST] request
>- the CSRF token is regenerated every time the for is reloaded [GET] or submitted [POST]
>- if CSRF token expire or resubmited the response is "Error-403 Unauthorized" 
>- CSRF token lifetime is 3600 seconds (60 minutes)
>- on this case the page need to reloaded by GET request (nem CSRF token is generated)
>- Unit tests in tests/Unit folder and rub fron project root folder
user@host$ vendor/bin/phpunit
__________________________________________________________________________________________
PHPUnit 8.4.3 by Sebastian Bergmann and contributors.

.......                                                             9 / 9 (100%)

Time: 39 ms, Memory: 4.00 MB

OK (9 tests, 29 assertions)
__________________________________________________________________________________________
