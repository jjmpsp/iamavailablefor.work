**iamavailablefor.work**
--------------------

iamavailablefor.work website source.
http://iamavailablefor.work/

----------

**Introduction**
----------------

iamavailablefor.work (abbreviated as IAAFW) is an open source website written in PHP which allows you to register your own iamavailablefor.work/{profile_name} web address for free. You can redirect this web address to your own personal blog/portfolio/website, or use our profile editor to build and customise your own portfolio.

IAAFW was written with a range of technologies and other open source softwares:

+ [CodeIgniter 3](https://github.com/bcit-ci/CodeIgniter/)
+ [Aauth](https://github.com/emreakay/CodeIgniter-Aauth/)
+ [Twitter Bootstrap](https://github.com/twbs/bootstrap)
+ More...

The master branch of this repository gets pulled by my server automatically whenever changes are made to it, so once a pull request has been accepted and merged with the master branch, your changes will instantly become visible on the live domain!

------------

**Roadmap:**
------------

I wanted to keep this project simple, but now that I've open sourced it, I have a few changes which I'd like implemented into the project.

**Core changes:**

 - Currently, there is only one theme implemented into the project. It would be cool if a theme changer could be implemented so the user could select from a repository of themes.

**Code changes:**

 - Add [grunt](http://gruntjs.com/) into the project so CSS and JS files are minified and compressed, reducing load on the server.

------------

**Screenshots:**
------------

![iamavailablefor.work default profile](https://lh3.googleusercontent.com/eezqylPDnvcj_bZ78n-Tk9n7PG4DUORKf_dhvoNII0g=w204-h656-no)


.DS_Store

/.htaccess

/index.php
/application/config/config.php
/application/config/database.php

/application/cache/
!application/cache/index.html
!application/cache/.htaccess

/application/logs/
!application/logs/index.html
!application/logs/.htaccess

/_tmp-folder/
/uploads/

*/config/development
*/logs/log-*.php
*/logs/!index.html
*/cache/*
*/cache/!index.html
*/cache/!.htaccess
