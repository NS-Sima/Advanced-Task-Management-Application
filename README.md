# Advanced-Task-Management-Application
#INSTRUCTIONS ON HOW TO SET UP THE PROJECT TO RUN LOCALLY IN PC
    i. The Project developed on ubuntu 22.04 os. For Laravel compatibility I recommend to run on machine with linux and php with version 8.1 and above.
    ii. For windows you can install php,git,composer. The navigate to git or command prompt for windows and terminal for linux users to run the following commands.
    iii. Extract the downloaded folder from github, navigate to the root directory of the project . Run “composer install” to install all php dependencies of the project
    iv. create a copy of .env example and rename it .env and run “php artisan key:generate” inside the project root directory.
    v. Configure database settings in .env file using with database name “ATMA” and password “Nyabunya@1999” ,you can change the password according to your mysql server configurations.
    vi. Run the command “php artisan migrate” to create database tables. You can use extracted sql to use testing data.
    vii. Run command “php artisan db:seed –class=DefaultSeeder” to create user with admin privilages.
    viii. Run comand “php artisan storage:link” to create storage link for uploaded files e.g. attachments.
    ix. Run the command “php artisan serve” to start the development server. Once started open the browser and use this link “http://127.0.0.0:8000” to access the project.
    x. Enter email address “systemadmin@gmail.com” and password “1234” to signin as admin, “system_manage@gmail.com” with password “1234” as manager and “systemuser@gmail.com” with password “1234” as user.
    xi. Then create manager, or users,teams and tasks to continue with prototype operations.
    xii. To this step you should be able to run and access the project on your local machine.
Sincerely,
	  Sima Seleman Nyabunya
	  System analyst and develper
	  Phone: 0687549790
	  Email: ismailseleman9@gmail.com
