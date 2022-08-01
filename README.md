## Installation

### :warning: Instructions are based on you having composer and docker installed :warning:


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


## Usage

Once you have run migrations and seeded the DB, you are ready to view the app. Head to http://localhost to get started.



### Notes 

When you first land, you will see the notes index. I have created the factories and seeders to provide dummy data to the db.

![Screen Shot 2022-08-01 at 12 53 15 AM](https://user-images.githubusercontent.com/48736345/182106696-046f78d9-8a7d-4498-a550-8a3eee3259d6.png)


If you click on the Add Note button, you will be presented a modal with a simple form.

![Screen Shot 2022-08-01 at 1 29 15 AM](https://user-images.githubusercontent.com/48736345/182107036-3c60168d-8fee-45a7-9897-2871fccf77cd.png)


I have included various features such as server-side validation and tag filtering.

![Screen Shot 2022-08-01 at 1 30 27 AM](https://user-images.githubusercontent.com/48736345/182107468-2af46714-baf3-4b26-a31f-d43878f85f12.png)


Upon successful submission, the modal disappears and your new note is appended to the list. You can also click cancel or press the `esc` key to close the modal.



### Tags

If you click the tags link at the top, you will be presented a simple tags page.

![Screen Shot 2022-08-01 at 1 36 47 AM](https://user-images.githubusercontent.com/48736345/182108424-4f76e7e0-a10b-4482-acf1-ce053d18e7c2.png)

Here you can easily delete a tag, and it will fall right off your list. You can also add a new tag by inputting the tag in the text box and pressing `Return` or `Enter` key, or simply clicking the Add Tag button.

Once you have added your tag, it is immediately available in the *Add Note* Section
