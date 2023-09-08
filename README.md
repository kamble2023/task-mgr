# task-mgr
This is a taks repo
# Build the project 
The following are the steps to build the project 
1. rename .env.example to .env
2. docker-compose up
3. enter into the laravel-app Dir
4. run php artisan migrate command

#Command to test the reminder emails
1. php artisan queue:listen
2. php artisan reminder:emails

