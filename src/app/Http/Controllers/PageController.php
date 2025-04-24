namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PageController extends Controller
{
    public function prueba()
    {
        return view('prueba');
    }
}