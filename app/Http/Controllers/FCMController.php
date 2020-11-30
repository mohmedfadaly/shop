<?php
namespace App\Http\Controllers;
use App\models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
class FCMController extends Controller
{
    public function index(Request $request)
    {
        $input = $request->all();
        $fcm_token = $input['token'];
        $user_id = $input['user_id'];
        $user = User::findOrFail($user_id);
        $user->fcm_token = $fcm_token;
        $user->save();
        return response()->json([
            'sucess' => true,
            'message' => 'User Updated Successfully',
        ]);
    }
}