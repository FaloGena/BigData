# Try different ways to transfer data

- Laravel 8.8
- PHP 7.4
- Jquery
- Bootstrap 4

Small app to import\export CSV in 3 ways (raw PHP, Laravel Excel and spatie/simple-excel) and save request execution time

</br>

Fields and validation:

      'user_name' => 'required|string|max:100|unique:custom_users,user_name|regex:/[\w\.]/', // Latin, digits and .
      
      'first_name' => 'required|string|max:100|regex:/[\x{0400}-\x{04FF}\-\s]/u', // Cyrillic, - and whitespace
      
      'last_name' => 'required|string|max:100|regex:/[\x{0400}-\x{04FF}\-\s]/u',
      
      'patronymic' => 'nullable|string|max:100|regex:/[\x{0400}-\x{04FF}\-\s]/u',
      
      'email' => 'required|email|unique:custom_users,email',
      
      'password' => 'required|string|between:8,100',


If you want to test it by yourself don't forget to 

```
composer install
php artisan migrate
```
