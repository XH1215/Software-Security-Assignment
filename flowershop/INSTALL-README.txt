Install Instructions
-------------------

Install PHP and MySQL on your webserver of choice

Turn off MagicQuotes in the php.ini file (makes SQL injection easier)

Copy files into webserver directory

Edit the flowershop.conf to reflect your install location

Open up the create_db.sql file in the SQL directory

start the MySQL command line interpreter

Copy the contents of the create_db.sql file into the MySQL command line
     (it's possible to do this in one large chunk, but advice is to
      copy a line or block at a time to manage any error messages that 
      appear)
      
Recompile the fakemail executable for your system if necessary
     (may have to fix up link in sendmessage.php depending on extention)
      
Go to the flowershop site and start finding bugs :)
