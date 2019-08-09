# MTN Cameroon Mobile Money Package for Laravel

### Installation
```bash
composer require malico/momo
```
### Setup

1. Publish the Configuration file with ``` php artisan vendor:publish --tag=momo-configuration ```
2. Update  ``` app/momo.php ``` with the approriate configurations.

	Configurations
	* email - Service used to create account on 	[https://developer.mtn.cm](https://developer.mtn.cm)
		> MOMO_EMAIL=email_address (.env)
	* default_price - Default price (amount)
		> MOMO_DEFAULT_PRICE=100 (.env), Default : 100
	* foreign_key - Column name in your migration that holds the Transactions

	Make sure you update your migrations to match the foreign_key provided in configuration file incase you want to use MomoTransaction trait
3. Run ```php artisan migrate ``` to run DB Migrations
4.

### Examples
Basic
```php

<?php

namespace App\Http\Controllers;

use Malico\Momo\Momo;
use Illuminate\Http\Request;

class SalesController extends Controller
{
    public function index()
    {
    	...

        $momo = new Momo($request->telephone_number);
        $transaction = $momo->pay();

        ...
		// $tranction is an Eloquent Model (\Momo\Model\Transaction)

        return $transaction;
    }
}
```

With Eloquent Relations
```php
<?php
// app/Sale.php
// Eloquent Model
namespace App;

use Malico\Momo\Support\MomoTransaction;
use Illuminate\Database\Eloquent\Model;

class Sale extends Model
{
	// use Momo\Support\MomoTransaction Trait
    use MomoTransaction;

    ...
}
```

```php

<?php
// SalesController.php
namespace App\Http\Controllers;

use App\Sale;
use Malico\Momo\Momo;
use Illuminate\Http\Request;

class SalesController extends Controller
{
    public function index()
    {
    	...
        $sale = new Sale();
        $sale->tel = $request->telephone_number;

        $momo = new Momo($request->telephone_number);

        // $price's the price of products or ...
        //
        $momo->price = $price ?? 200;
        $transaction = $momo->pay()
        $sale->momo_transaction_id = $transaction->id;

        $sale->save();

        if($sale->momo_transaction->status){
        	// :) Successful paid $price to your account
        	...

        } else {
        	// :( Transaction Error
        	...

        }

        ...

        return $sale::with('momo_transaction');
    }
}
```

### Contribute
All contributions are welcomed, but hey before working on a feature, please kindly suggest it as a new issue. And remember Clean code Rocks.

##### License
MIT

