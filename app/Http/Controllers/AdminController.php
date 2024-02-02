<?php

namespace App\Http\Controllers;

use App\Models\Invoice;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class AdminController extends Controller
{
    private int|float $CACHE_TIME = 60 * 2; // 2 minutes

    /*
     * AdminController constructor.
     */
    public function __construct()
    {
    }


    public function index()
    {
        return view('admin');
    }
    // todo - lessons
    //  - Get through whole flow
    /*
    * Admin Dashboard
    * @return \Illuminate\Http\Response
    * */
    public function dashboard()
    {
//        $tables = DB::select('SHOW TABLES');
//        dd($tables);


        $users = User::all();
        return view('admin.dashboard', compact('users'));
    }

    /*
     * Admin Rentals
     * @return \Illuminate\Http\Response
     * */
    public function rentals()
    {
        $users = User::all();
        $models = $users;
        return view('admin.rentals.index', compact('users', 'models'));
    }

    /*
     * Admin Rentals Store
     * @return \Illuminate\Http\Response
     */
    public function rentalsStore(Request $request)
    {

        // todo - need to crop images, etc...
//        $request->validate(['image' => 'required|image|file|mimes:jpeg,png,jpg,gif,svg|max:10000']);

        return response()
            ->json([
                'path' => $request->file('image')
                    ->store('tmp', 'public')
            ]);


//        dd($request->all());
//
//        // todo - validation
//        $request->validate([
////            'user_id' => 'required',
//            'full_name' => 'required',
////            'phone' => 'required',
////            'price' => 'required',
////            'address_line_1' => 'required',
////            'address_line_2' => 'required',
////            'city' => 'required',
////            'state' => 'required',
////            'zip' => 'required',
////            'images' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
//        ]);
//
//        // todo - add rentals store
//        return redirect()->back()->with('success', 'Rental added successfully');

    }

    /*
     * Admin Rentals Tmp Upload
     * @return \Illuminate\Http\Response
     */
    public function rentalsTmpUpload(Request $request)
    {
        // todo - need to crop images, etc...
//        $request->validate(['image' => 'required|image|file|mimes:jpeg,png,jpg,gif,svg|max:10000']);

        return response()
            ->json([
                'path' => $request->file('image')
                    ->store('tmp', 'public')
            ]);
    }


    /*
     * Admin Database
     * @return \Illuminate\Http\Response
     * */
    public function database()
    {
        return view('admin.database.index');
    }

    /*
     * Admin Invoices
     * @return \Illuminate\Http\Response
     * */
    public function invoices()
    {
        $users = User::all();
        $invoices = Invoice::with('user')->get();
        return view('admin.invoices.index', compact('users', 'invoices'));
    }

    public function documents()
    {
        // todo - add documents
        $users = User::all();
        $documents = [];
        return view('admin.documents.index', compact('users', 'documents'));
    }

    public function messages()
    {
        $users = User::all();
        $instruments = Instrument::all();
        return view('admin.messages.index', compact('users', 'instruments'));
    }

    public function settings()
    {
        $users = User::all();
        $instruments = Instrument::all();
        return view('admin.settings.index', compact('users', 'instruments'));
    }

    public function users()
    {
        $users = User::all();
        $teachers = User::where('type', 'teacher')->get();
        $teachers = $this->addRandomAvatar($teachers);
        return view('admin.users.index', compact('users', 'teachers'));
    }

    public function admins()
    {
        $admins = User::where('type', 'admin')->get();
        return view('admin.admins.index', compact('admins'));
    }

    /* ------------------------------------------------ */

    /*
     * Admin Routes
     * @return \Illuminate\Http\JsonResponse
     * */
    public function superAdminRoute()
    {
        if ($this->isSuperAdmin()) {
            return response()->json(['message' => 'You are super admin']);
        } else
            return response()->json(['message' => 'You are not super admin']);
    }

    /*
     * cmac and youcef routes only
     * */
    private function isSuperAdmin()
    {
        // If is user id 1 or 20
        define('SUPER_ADMIN', [1, 20]);
        return in_array(auth()->user()->id, SUPER_ADMIN);
    }

    /*
 * Admin Dashboard
 * @return \Illuminate\Http\Response
 * */
    private function addRandomAvatar($users)
    {
        // avatars
        $data = ['user-1.jpeg', 'user-2.png', 'user-3.jpeg', 'user-4.jpeg'];
        // add random avatar to each user
        foreach ($users as $user) {
            $user->avatar = $data[array_rand($data)];
        }
        return $users;
    }


    /* ------------------------------------------------ */
    /*  ---------------- API Routes ------------------ */
    /*------------------------------------------------- */

    /*
     * API function for totals
     * @return \Illuminate\Http\JsonResponse
     * */
    public function apiTotals()
    {
        $cached = Cache::remember('totals', $this->CACHE_TIME, function () {
            return [
                'users' => User::count(),
                'admins' => User::where('type', 'admin')->count(),
                'teachers' => User::where('type', 'teacher')->count(),
                'parents' => User::where('type', 'parent')->count(),
                'students' => User::where('type', 'student')->count(),
                'instruments' => Instrument::count(),
                'lessons' => Lesson::count(),
            ];
        });

        return response()->json(['totals' => (array)$cached]);
    }

    /*
     * Get all users
     * @return \Illuminate\Http\JsonResponse
     * */
    public function allUsers()
    {
        $users = User::all();
        return response()->json($users);
    }

    /*
     * Get all admins
     * @return \Illuminate\Http\JsonResponse
     * */
    public function allAdmins()
    {
        $admins = User::where('type', 'admin')->get();
        return response()->json($admins);
    }

    /*
     * Get all students
     * @return \Illuminate\Http\JsonResponse
     * */
    public function allStudents()
    {
        $students = User::where('type', 'student')->get();
        return response()->json($students);
    }
}
