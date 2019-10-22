<?php
namespace App\Http\Controllers;
use App\User;
use App\Organization;
use App\SOCC;
use App\OSA;
use App\Role;
use App\AuthorizedPersonnel;
use Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use JWTAuth;
use Tymon\JWTAuth\Exceptions\JWTException;
use Illuminate\Support\Facades\Config;

class UserController extends Controller
{
    public function authenticate(Request $request)
    {
        $email = $request->email;
        $password = $request->password;

        if (Auth::attempt(['email' => $email, 'password' => $password])) {
            $user = User::where('email', $request->input('email'))->first();

            if ($user->status == 0) {
                return response()->json(['error' => 'Account is deactivated. Please go to System Administrator.', 'success' => false]);
            }
            session(['user_id' => $user->id, 'role_id' => $user->role_id, 'first_name' => $user->first_name, 'last_name' => $user->last_name]);

            $role_instance = static::getUserRoleInstance($user);

            return response()->json(['url' => '/dashboard', 'success' => true]);

        }
        else {
            return response()->json(['error' => 'Invalid credentials.', 'success' => false]);
        }


        // $credentials = $request->only('email', 'password');
        // try
        // {
        //     if(!$token = JWTAuth::attempt($credentials))
        //     {
        //         return response()->json([
        //             'error' => 'Invalid Credentials'
        //         ], 400);
        //     }
        // }
        // catch(JWTException $e)
        // {
        //     return response()->json([
        //         'error' => 'could_not_create_token'
        //     ], 500);
        // }

        // Retrieve the entire user instance 
       
        /* $user->role = $role_instance; */
        // return response()->json([
        //     'token' => $token,
        //     'user' => $user,
        // ]);
        /* return response()->json(compact('token', 'user', 'role_instance')); */
    }

    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6',
        ]);

        if($validator->fails()){
            return response()->json($validator->errors()->toJson(), 400);
        }

        /* $user = User::create([ */
        /*     'name' => $request->get('name'), */
        /*     'email' => $request->get('email'), */
        /*     'password' => Hash::make($request->get('password')), */
        /* ]); */

        $user = static::createUser($request);
        $user->save();
        $sub_user = static::createSubUser($request, $user->id);
        $sub_user->save();

        // $token = JWTAuth::fromUser($user);

        // return response()->json(compact('user','token'),201);
        return response()->json(['success' => true]);
    }


    public function getAllRoles() {
        $roles = Role::all();
        return response()->json($roles);
    }

    private static function createUser(Request $request)
    {
        $user = new User();
        $user->email = $request->get('email');
        $user->first_name = $request->get('first_name');
        $user->last_name = $request->get('last_name');
        $user->password = Hash::make($request->get('password'));
        $user->student_number = $request->get('student_number') ?: null;
        $user->role_id = $request->get('role_id');
        return $user;
    }

    private static function createSubUser(Request $request, $user_id)
    {
        $role_id = $request->get('role_id');
        if($role_id == 1)
        {
            $sub_user = new Organization();
            $sub_user->user_id = $user_id;
            $sub_user->name = $request->get('organization_name');
            $sub_user->type = $request->get('organization_type');
            $sub_user->college = $request->get('organization_college');
        }
        elseif($role_id == 2)
        {
            $sub_user = new SOCC();
            $sub_user->user_id = $user_id;
        }
        elseif($role_id == 3)
        {
            $sub_user = new OSA();
            $sub_user->user_id = $user_id;
        }
        return $sub_user;
        /* switch($request->get('role_id')) */
        /* { */
        /*     case (int)Config::get('constants.roles.organization'): */
        /*         $sub_user = new Organization(); */
        /*         $sub_user->user_id = $user_id; */
        /*         $sub_user->name = $request->get('organization_name'); */
        /*         $sub_user->type = $request->get('organization_type'); */
        /*         $sub_user->college = $request->get('organization_college'); */
        /*         $sub_user->save(); */
        /*         break; */
        /*     case (int)Config::get('constants.roles.socc'): */
        /*         $sub_user = new SOCC(); */
        /*         $sub_user->user_id = $user_id; */
        /*         $sub_user->save(); */
        /*         break; */
        /*     case (int)Config::get('constants.roles.osa'): */
        /*         $sub_user = new OSA(); */
        /*         $sub_user->user_id = $user_id; */
        /*         $sub_user->save(); */
        /*         break; */
        /* } */
    }

    public function generateNewPassword() {
        $password_length = 6;
        $password = substr(str_shuffle(str_repeat($x = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ', ceil($password_length / strlen($x)))), 1, $password_length);

        return compact('password');
    }

    public function getAuthenticatedUser()
    {
        try {

            if (! $user = JWTAuth::parseToken()->authenticate()) {
                return response()->json(['user_not_found'], 404);
            }

        } catch (Tymon\JWTAuth\Exceptions\TokenExpiredException $e) {

            return response()->json(['token_expired'], $e->getStatusCode());

        } catch (Tymon\JWTAuth\Exceptions\TokenInvalidException $e) {

            return response()->json(['token_invalid'], $e->getStatusCode());

        } catch (Tymon\JWTAuth\Exceptions\JWTException $e) {

            return response()->json(['token_absent'], $e->getStatusCode());

        }

        return response()->json(compact('user'));
    }    

    public function index()
    {
        $users = User::all()->each(function($user) { 
            switch($user->role_id)
            {
            case Config::get('constants.roles.organization'):
                $user->organization = $user->organization()->with('events')->get();
                break;
            case Config::get('constants.roles.socc'):
                $user->socc = $user->socc()->with('events')->get();
                break;
            case Config::get('constants.roles.osa'):
                $user->osa = $user->osa()->with('events')->get();
                break;
            }
        });
        return response()->json([
            'users' => $users
        ]);
    }

    public function show($id)
    {
        $context = [
            'user' => User::find($id)
        ];
        return response()->json($context);
    }

    public function getAllUsers()
    {
        $users = User::with('role')->where('id', '!=', auth()->user()->id)->get();
        return response()->json($users);
    }


    public function destroy($id)
    {
        $user = User::find($id);
        if($user)
        {
            $user->delete();
            return response()->json([
                'user' => $user
            ]);
        }
        else 
        {
            return response()->json([
                'status' => 'User not found'
            ]);
        }
    }

    public function showDashboard() {   
        return view('dashboard.dashboard');
    }

    public function showAdministratorPage() {   
        $check_ap = AuthorizedPersonnel::all();
        if(count($check_ap) > 0) {
            $ap = AuthorizedPersonnel::find(1);
        }
        else {
            $ap = array();
        }  

            return view('dashboard.administrator', compact('ap'));
    }

    


    public function getArchivedUsers() {
        return response()->json([
            'users' => User::onlyTrashed()->get()
        ]);
    }

    public function UpdatePassword(Request $request)
    {
        $user = User::find(auth()->user()->id);
        $field = array();
        $message = '';
        if ($request->new_password === $request->confirm_password && Hash::check($request->current_password, $user->password)) {
            if (Hash::check($request->new_password, $user->password)) {
                $status = false;
                $result = "error";
                $message = "New password cannot be the same as your current password.";
            } else {
                $user->password = Hash::make($request->new_password);

                $user->save();
                $status = true;
                $result = "success";
                $message = "You have successfully updated your password.";
            }
        } else {
            $status = false;
            $result = "error";
            if (!Hash::check($request->current_password, $user->password)) {
                $message = "Incorrect Password";
                $field[] = array('field' => 'current_password', 'message' => $message);
            }
            if ($request->new_password != $request->confirm_password) {
                $message = "New Password does not match";
                $field[] = array('field' => 'confirm_password', 'message' => $message);
            }
        }

        $response = array(
            "success" => $status,
            "result" => $result,
            "message" => $message,
            "field" => $field,
        );

        return response()->json($response);
    }

    public function massDeactivate() 
    {
        $users = User::where('role_id', '<>', Config::get('constants.roles.osa'));

        $deactivated_users = $users->get();
        $deactivated_user_count = $users->count();

        $users->delete();

        return response()->json([
            'users' => $deactivated_users,
            'count' => $deactivated_user_count
        ]);
    }

    public function massActivate() 
    {
        $users = User::onlyTrashed()->where('role_id', '<>', Config::get('constants.roles.osa'));

        $activated_users = $users->get();
        $activated_user_count = $users->count();

        $users->restore();

        return response()->json([
            'users' => $activated_users,
            'count' => $activated_user_count
        ]);
    }


    public function updateStatus(Request $request) {
        $user = User::find($request->id);
        $user->status = (int) $request->status;
        if($user->save()){
            return response()->json(["success" => true]);
        }
    }

    public function updateApInfo(Request $request) {
        $ap = AuthorizedPersonnel::firstOrNew(['id' => 1]);
        $ap->ap_name = $request->ap_name;
        $ap->ap_position = $request->ap_position;
        if($ap->save()){
            return response()->json(["success" => true]);
        }
    }


    


    // Helper Functions
}
