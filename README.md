 :warning: Instructions are based on you having composer and docker installed :warning:

- Download repo and extract



- In terminal, change to root of notes-master. 

    For me, it was: `cd Downloads/notes-master`



- Copy the .env.example to .env by running:

    `cp .env.example .env`



- Run `composer install`

    This installs all the necessary composer packages, including what we need for our docker container.



- Once the install process is complete, we need to build our container. 
    
    Sail is in our /vendor/bin directory, so run: `./vendor/bin/sail up`
    
    This is going to build and prep our docker container. This container has everything we need to run our app. It may take a moment to install everything the first time, but it will be super fast every time after.

    :warning: NOTE: **If you get an error** stating that the port is already in use, we can modify the port assignments inline and try again, like this:

    `APP_PORT=85 FORWARD_DB_PORT=3370 ./vendor/bin/sail up -d`

   
   
Once sail is up, we are almost done!



- Run `./vendor/bin/sail npm install && ./vendor/bin/sail npm run dev`

    This installs all of our npm packages and compiles our js and css in our docker container.



- Lastly, lets build our table structure and constraints and populate it with data.

    `./vendor/bin/sail artisan migrate —seed`
    
    

Now we can visit our app by visiting http://localhost/ in your web browser. If you had to manually set the port number above, you will need to include that in the URL. (i.e. http://localhost:85)

