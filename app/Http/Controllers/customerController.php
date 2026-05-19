namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CustomerController extends Controller
{
    public function index()
    {
        return view('Customer.index');
    }

    public function create()
    {
        return view('Customer.create');
    }

    public function edit($id)
    {
        return view('Customer.update');
    }

    public function destroy($id)
    {
        return view('Customer.delete');
    }
}