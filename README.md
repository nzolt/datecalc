# Workforce date calculator

Code owner: Zoltan Nagy <nzolthu@gmail.com>

Calculate | Years | Days | Hours | from a given date

Format: YYYY-MM-DD HH:MM or YYYY-MM-DD

Mauin Url: http(s)://localhost (when called resets the SESSION / delete stored dates)
- generates CSRF token for security

Calculate: http(s)://localhost/oldhours (can be accessed only from main /index/ page))
- stores maximum 100 latest dates in Session (deleting the oldest one and adding the new to the top of the list)
