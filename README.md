### postman
POSTMAN: https://documenter.getpostman.com/view/13857857/2s847HNCV7

### creating project laravel
 First of all I ran composer create-project laravel/laravel book_store_search_and_stay
 * to create the project and saved it to the repository: https://github.com/gabrieltenachous/book_store_search_and_stay- create migration book_store -

### create migration book_store relation user and user (softDeletes)
* I created the migration with php artisan make:migration create_book_store_table, I created the softdelete for the user and the bookstore for security reasons the user an important column he can consult later in the database,
* I created a foreign key for the bookstore, I created the mandatory name string, mandatory integer isbn and mandatory decimal value.

### create model book_store
 * I created the php artisan make BookStore, contain its attributes in the fillable and counted the relations between usumodal with bookstore
 * and at the end I added SoftDeletes in the Model use Illuminate\Database\Eloquent\SoftDeletes;

### installing and setting sanctum laravel (used to authenticate user with bearer token)
* na documentacao do laravel https://laravel.com/docs/9.x/sanctum I ran the following commands to run the sanctum bearer token: composer require laravel/sanctum
,php artisan vendor:publish --provider="Laravel\Sanctum\SanctumServiceProvider", e em seguida rodo o 'api' => [
    \Laravel\Sanctum\Http\Middleware\EnsureFrontendRequestsAreStateful::class,
    'throttle:api',
    \Illuminate\Routing\Middleware\SubstituteBindings::class,
],
and I run the EnsureFrontendRequestsAreStateful in the api to work the SPA to be able to authenticate the routes with the middleware
'api' => [
            \Laravel\Sanctum\Http\Middleware\EnsureFrontendRequestsAreStateful::class,
            'throttle:api',
            \Illuminate\Routing\Middleware\SubstituteBindings::class,
        ],

### creating routes in laravel (CRUD book,login user and register user)
* I created an authentication for the library api via middleware, I used Resource api to use all methods (PUT,GET,POST,DELETE) and use php artisan make:BookStoreController --resource to create all methods automatically,in user controller I created 2 post methods (login and registration) and a get logout method to delete bearer token authentication 
### validation request LoginRequest
* I added email as mandatory, type string, validate email, maximum 255 characters
* required password, string type, maximum 255 characters
### validation request RegisterRequest 
* password compared if password_confirmation was equal to password
* email checked if it was a single user
### validation request BookStoreRequest
* isbn and value I check if the value is between 0 to y so as not to give an error in the bank I put isbn as an integer and value numeric
### create controller LoginController,RegisterController and logout  
* I created Mutators and Casting for password hash in setPasswordAttribute template
* login check if the user exists if not return 503 if yes return the token
* logout it destroys the token having to generate a new one
* register uses RegisterUserRequest to validate before submitting the form
### create CRUD book_store in controller 
* get => called all users paging 50
* post => I used the BookStoreRequest to validate the submission, I used array_merge to add the user_id in the request,
* get with id => I used find to bring up a specific bookstore
* put => check if the library exists before submitting the form
* delete => check if the library exists before deleting

