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

## CRUD Challenge part 2 (INTERFACE,VALIDATION,RELATION CATEGORIES N*N and PAGINATION)

### creating repositories and interfaces for the index method in BookStoreCon…
* In summary, about repository and interface, it is widely used for code optimization, code abstraction, Controller is no longer responsible for calling the Model directly, it is always instantiated by the Interface
* Methods like index call the Interface to bring in the data from the Model (ORM)
* I bind Laravel to understand that this is a Respository instance so it doesn't give an "not instantiable" error.

### CRUD BookStore Repositories, Interface and Validation
* Changes the rest of the methods to be called by the Interface
* Inside the interface I call the create, find, update and destroy methods

### Change the BookStore nullable attribute and install doctrine/dbal in comp…
* I instantiated the doctrine/dbal , so I can change the columns to nullable

### Create migration categories, book_stores_categories and replace migrate…
*created as migration categories and book_stores_categories
* Note: I had forgotten to put the Foreign more for us to commit I'll add it

### Create Model BookStoreCategory and Category with relation
* Creation of models and relationships

### Create controller route and category

### Validation CategoryRequest
* validation of categories: exists checks if there is an id of this table

### create index (get) categories with Interace,Repositories in Controller
* Same work with BookStore, adding the bind to the AppServiceProvider.php, creating the interfaces and Category repository and changing the name of the table in the model

### create store category with relation book_stores_categories
* in the store in addition to creating the category table I can relate to the books (several) so I can put several books_stories creating this relationship when saving
* I fixed some related ones in the model and added the $with to bring all the hasmany from book_store_categories ready

### CRUD category finished* Crud de category parcialmente finalizado, instanciei todos as Interfaces e modifiquei as validações

### fixing a category validation

* I did valdiacacao for POST AND PUT because they are different treatments
### Add Category in BookStoreController
* I gave the save to object array type to handle better when saving!
* validation for book_stores_categories.* when there are several and *.book_store_id to call the id of book_store, validating if it is distinct if it has a repeated value in the array
### adjusting CategoryRequest


### create route/repository/interface and controller for paginate
* creation of pagination via post, for the user to send the limit of pages if null returns by default 0 - 10
* creation of route /v1/category/paginate and /v1/book_store/paginate

### Create Repository,Interface in UserController
* and finally I put the interface in the User registration and in the login, it was necessary a new method to work the filter inside the UserRepository

