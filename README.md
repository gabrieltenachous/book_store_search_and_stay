### creating project laravel
 *First of all I ran composer create-project laravel/laravel book_store_search_and_stay
 *to create the project and saved it to the repository: https://github.com/gabrieltenachous/book_store_search_and_stay- create migration book_store -

### create migration book_store relation user and user (softDeletes)
 * I created the migration with php artisan make:migration create_book_store_table, I created the softdelete for the user and the bookstore for security reasons the user an important column he can consult later in the database,
  * I created a foreign key for the bookstore, I created the mandatory name string, mandatory integer isbn and mandatory decimal value.

### create model book_store
 * I created the php artisan make BookStore, contain its attributes in the fillable and counted the relations between usumodal with bookstore
 * and at the end I added SoftDeletes in the Model use Illuminate\Database\Eloquent\SoftDeletes;

### installing and setting sanctum laravel (used to authenticate user with bearer token)
na documentacao do laravel https://laravel.com/docs/9.x/sanctum I ran the following commands to run the sanctum bearer token: composer require laravel/sanctum
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
I created an authentication for the library api via middleware, I used Resource api to use all methods (PUT,GET,POST,DELETE) and use php artisan make:BookStoreController --resource to create all methods automatically,in user controller I created 2 post methods (login and registration) and a get logout method to delete bearer token authentication


### validation request LoginRequest
*eu adicionei email como obrigatorio,tipo string,validar o email, maximo 255 caracteres
*senha obrigatorio, tipo string, maximo 255 caracteres
### validation request RegisterRequest
*password comparei se password_confirmation era igual a password
*email verifiquei se era usuario unico
### validation request BookStoreRequest
*isbn e value verifico se o valor e entre 0 ate y para nao dar erro no banco coloco isbn como integer e o value numeric
### create controller LoginController,RegisterController and logout
*login verifico se o usuario existe caso não retorna 503 se sim retorn a o token
*logout ele destroy o token tendo que gerar um novo
*register utiliza RegisterUserRequest para validar antes de enviar o formulario
### create CRUD book_store in controller 
*get => chamei todos os usuario paginando 50
*post => utiizei o BookStoreRequest para validar o envio, usei array_merge para adicionar o user_id no request,
*get with id => usei o find para trazer um bookstore especifico
*put => verifico se bookstore existe antes de enviar o formulario
*delete => verifico se o bookstore existe antes de deletar