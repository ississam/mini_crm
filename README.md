<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400"></a></p>

<p align="center">
<a href="https://travis-ci.org/laravel/framework"><img src="https://travis-ci.org/laravel/framework.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>

</p>

## Install the project

1.Clone the project : Run `git clone 'link projer github'

2.Install composer : Run composer install

3. Create .env file : Run cp .env.example .env or copy .env.example .env

4.Add database parametres (name, ..) and SMTP parameters.

5.Generate a key : Run php artisan key:generate

6.Create a database and run php artisan migrate

7.Seed the tables : Rund php artisan db:seed

7.Change


## use API end points:

1.Login : api/login.
  Data:{
   "email":"email",
   "password":"password"
   }
   
2.Invite an employe : /api/employe/invite
  Data={
   "email":"email",
   "name": "employe name"
    }
 
3.Edit employe profile :/api/employe/completeprofile/employeid
  Data={
            "name":"name",
            "password" : "password",
            "adress" : " adress",
            "tel" : "tel",
            "born_date" : "born_date"
      }
      
 4.Update company : /company/update/{id}
  Send data to change.
  
 5.Delete company:/company/delete/idcompany
 
