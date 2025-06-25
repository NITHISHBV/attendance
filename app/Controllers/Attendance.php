<?php
namespace App\Controllers;
use App\Models\UserModel;
use App\Models\AttendanceModel;

class Attendance extends BaseController
{
    public function index() {
        return view('attendance_form');
    }

    public function login() {
        $email = $this->request->getPost('email');
        $password = $this->request->getPost('password');
        $location = $this->request->getPost('location');

        $userModel = new UserModel();
        $user = $userModel->where('email', $email)->first();

        if ($user && password_verify($password, $user['password'])) {
            $attendanceModel = new AttendanceModel();
            $attendanceModel->save([
                'user_id' => $user['id'],
              'name' => $user['name'], 
                'type' => 'login',
                'location' => $location
            ]);
            return $this->response->setJSON(['status' => 'success', 'message' => 'Your attendance is marked']);
        } else if (!$user) {
            return $this->response->setJSON(['status' => 'register']);
        } else {
            return $this->response->setJSON(['status' => 'error', 'message' => 'Invalid credentials']);
        }
    }

    public function logout() {
        $email = $this->request->getPost('email');
        $location = $this->request->getPost('location');

        $userModel = new UserModel();
        $user = $userModel->where('email', $email)->first();

        if ($user) {
            $attendanceModel = new AttendanceModel();
            $attendanceModel->save([
                'user_id' => $user['id'],
                 'name' => $user['name'], 
                'type' => 'logout',
                'location' => $location
            ]);
            return $this->response->setJSON(['status' => 'success', 'message' => 'Your logout attendance is marked']);
        } else {
            return $this->response->setJSON(['status' => 'error', 'message' => 'User not found']);
        }
    }

    public function register() {
        return view('register');
    }

    public function saveRegister() {
        $userModel = new UserModel();
        $data = [
            'name' => $this->request->getPost('name'),
            'email' => $this->request->getPost('email'),
            'password' => password_hash($this->request->getPost('password'), PASSWORD_DEFAULT)
        ];
        $userModel->save($data);
        return redirect()->to('/');
    }
}
