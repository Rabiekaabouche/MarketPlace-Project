<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/*class Images extends Model
{
    use HasFactory;
}*/
/*<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
*/
class Images extends Model
{
    protected $fillable = ['NomProd', 'prod_image'];
}
