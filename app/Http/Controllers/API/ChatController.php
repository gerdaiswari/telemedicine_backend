<?php

namespace App\Http\Controllers\API;

use Carbon\Carbon;
use App\Models\User;
use App\Models\Doctor;
use Illuminate\Http\Request;
use Kreait\Firebase\Factory;
use App\Http\Controllers\Controller;

class ChatController extends Controller
{
    public function __construct()
    {
        $factory = (new Factory)
            ->withServiceAccount(__DIR__ . '/telemedicine-id-firebase-adminsdk-g7m3c-760e9339f1.json')
            ->withDatabaseUri(env('FIREBASE_DATABASE_URI'));

        $this->auth = $factory->createAuth();
        $this->database = $factory->createDatabase();
    }

    public function sendChat(Request $request)
    {
        $data = $request->validate([
            'doctor_id' => 'required|integer',
            'user_id' => 'required|integer',
            'message' => 'required|string',
        ]);
        $user = User::where('id', '=', $data['user_id'])->get()[0];
        $doctor = Doctor::where('id', '=', $data['doctor_id'])->get()[0];

        $date = Carbon::now()->addHour(7)->toDateTimeString();

        $ref = $this->database->getReference('chatroom/' . $data['doctor_id'] . '-' . $data['user_id'] . '/chat')
            ->push([
                "message" => $data['message'],
                "sender" => "doctor",
                "time" => $date,
            ]);

        // Push Notification
        $url = "https://fcm.googleapis.com/fcm/send";
        $curl = curl_init();
        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_POST, true);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);

        $headers = array(
            "Accept: application/json",
            "Content-Type: application/json",
            "Authorization: ".env('FIREBASE_CLOUD_MESSAGING_AUTH')
        );
        curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);

        $data_array = array (
            "registration_ids" => [$user->fcm_token],
            "data" => array(
                "notification" => array(
                    "notification_type"=> "chat",
                    "doctor_id"=> $doctor->id,
                    "doctor_name"=> $doctor->name,
                    "doctor_photo"=> $doctor->photo,
                    "message"=> $data['message']
                )
            )
        );
        $data = json_encode($data_array);

        curl_setopt($curl, CURLOPT_POSTFIELDS, $data);

        $resp = curl_exec($curl);
        curl_close($curl);
        $resp = json_decode($resp, true);

        return response()->json([
            'message' => "Chat berhasil dikirim",
            'fcm_resp' => $resp
        ], 201);
    }

    public function getChatroomByDoctorId(Request $request)
    {
        // $doctorId = 2;
        $doctorId = $request->doctorId;

        $reference = $this->database->getReference('chatroom/');
        $keys = $reference->getChildKeys();
        $newKeys = array();
        $user = array();
        foreach ($keys as $value) {
            $chatDoctor = explode("-", $value)[0];
            $chatUser = explode("-", $value)[1];
            if ($chatDoctor == $doctorId) {
                array_push($newKeys, $value);
                array_push($user, $chatUser);
            }
        }

        return response()->json([
            'keys' => $newKeys,
            'user' => $user
        ], 201);
    }
     
}
