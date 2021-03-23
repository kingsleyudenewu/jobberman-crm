# Jobberman CRM
An application built with using Laravel on the backend and Vuejs on the frontend to help create
 employees and companies. 


<p>
  <blockquote style="color:red">
    **Please follow the steps below to run the code on your local system** 
  </blockquote>
</p>  
  
<div class="highlight">
<pre>
    - Clone project
    - Run composer install
    - Rename .env.example to .env
    - Create you database and set dname, username and password on the new .env file
    - Run npm install & npm run watch
    - Generate your laravel key (php artisan key:generate)
    - Run php artisan migrate
    - Run php artisan db:seed to generate dummy data for both admin user, employee and companies.
    - Note that the default user for admin is test@test.com and the password is "password"
    - Start your application by running php artisan serve 
    - To run your <b>TEST</b> go to your console and type ./vendor/bin/phpunit
</pre>
</div>


### View Project On Heroku
```sh 
Heroku URL: ![](https://jobberman-crm.herokuapp.com)

Admin Default Account:
- Email: test@test.com
- Password: password

Company Login URL: ![](http://jobberman-crm.herokuapp.com/company/login)

Employee Login URL: http://jobberman-crm.herokuapp.com/employee/login  
```
