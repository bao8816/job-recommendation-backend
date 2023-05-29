<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AdminController extends ApiController
{
    public function getAdmin(Request $request): JsonResponse
    {
        try {
            $admin = Admin::where('username', 'Admin')->first();

            if (!$admin) {
                return $this->respondNotFound();
            }

            return $this->respondWithData(
                [
                    'admin' => $admin,
                ]);
        }
        catch (Exception $exception) {
            return $this->respondInternalServerError($exception->getMessage());
        }
    }

    public function createModAccount(Request $request): JsonResponse
    {
        try {
            $username = $request->username;
            $password = $request->password;
            $passwordSalt = $password . env('PASSWORD_SALT');

            if (Admin::where('username', $username)->exists()) {
                return $this->respondBadRequest('Tên đăng nhập đã tồn tại');
            }

            $hashedPassword = Hash::make($passwordSalt);

            $modAccount = new Admin();
            $modAccount->username = $username;
            $modAccount->password = $hashedPassword;
            $modAccount->save();

            return $this->respondCreated(
                [
                    'modAccount' => $modAccount,
                ]);
        }
        catch (Exception $exception) {
            return $this->respondInternalServerError($exception->getMessage());
        }
    }

    public function getAllMods(Request $request): JsonResponse
    {
        try {
            $count_per_page = $request->count_per_page ?? 10;

            $mods = Admin::where('username', '!=', 'Admin')->paginate($count_per_page);

            if (count($mods) === 0) {
                return $this->respondNotFound();
            }

            return $this->respondWithData(
                [
                    'mods' => $mods,
                ]);
        }
        catch (Exception $exception) {
            return $this->respondInternalServerError($exception->getMessage());
        }
    }

    public function getModById(string $id): JsonResponse
    {
        try {
            $mod = Admin::where('id', $id)->first();

            if (!$mod) {
                return $this->respondNotFound();
            }

            return $this->respondWithData(
                [
                    'mod' => $mod,
                ]);
        }
        catch (Exception $exception) {
            return $this->respondInternalServerError($exception->getMessage());
        }
    }

    public function updateModAccount(Request $request, string $id): JsonResponse
    {
        try {
            $mod = Admin::where('id', $id)->first();

            if (!$mod) {
                return $this->respondNotFound();
            }

            $mod->full_name = $request->full_name ?? $mod->full_name;
            $mod->avatar = $request->avatar ?? $mod->avatar;
            $mod->save();

            return $this->respondWithData(
                [
                    'mod' => $mod,
                ]);
        }
        catch (Exception $exception) {
            return $this->respondInternalServerError($exception->getMessage());
        }
    }

    public function updatePassword(Request $request): JsonResponse
    {
        try {
            $account = Admin::where('id', $request->user()->id)->first();

            if (!$account) {
                return $this->respondNotFound();
            }

            $current_password = $request->current_password;
            $new_password = $request->new_password;
            $confirm_password = $request->confirm_password;
            $new_password_salt = $new_password . env('PASSWORD_SALT');

            if (!Hash::check($current_password, $account->password)) {
                return $this->respondBadRequest('Mật khẩu cũ không đúng');
            }

            if ($new_password !== $confirm_password) {
                return $this->respondBadRequest('Mật khẩu xác nhận không khớp');
            }

            $hashedPassword = Hash::make($new_password_salt);

            $account->password = $hashedPassword;
            $account->save();

            return $this->respondWithData(
                [
                    'account' => $account,
                ]);
        }
        catch (Exception $exception) {
            return $this->respondInternalServerError($exception->getMessage());
        }
    }

    public function deleteModAccount(string $id): JsonResponse
    {
        try {
            $mod = Admin::where('id', $id)->first();

            if (!$mod) {
                return $this->respondNotFound();
            }

            $mod->delete();

            return $this->respondWithData(
                [
                    'mod' => $mod,
                ], 'Xóa thành công');
        }
        catch (Exception $exception) {
            return $this->respondInternalServerError($exception->getMessage());
        }
    }

    public function banModAccount(string $id): JsonResponse
    {
        try {
            $mod = Admin::where('id', $id)->first();

            if (!$mod) {
                return $this->respondNotFound();
            }

            if ($mod->username === 'Admin') {
                return $this->respondForbidden('Không thể khóa tài khoản admin');
            }

            $mod->is_banned = true;
            $mod->save();

            return $this->respondWithData(
                [
                    'mod' => $mod,
                ]);
        }
        catch (Exception $exception) {
            return $this->respondInternalServerError($exception->getMessage());
        }
    }

    public function unbanModAccount(string $id): JsonResponse
    {
        try {
            $mod = Admin::where('id', $id)->first();

            if (!$mod) {
                return $this->respondNotFound();
            }

            $mod->is_banned = false;
            $mod->save();

            return $this->respondWithData(
                [
                    'mod' => $mod,
                ]);
        }
        catch (Exception $exception) {
            return $this->respondInternalServerError($exception->getMessage());
        }
    }

    public function lockModAccount(Request $request, string $id): JsonResponse
    {
        try {
            $mod = Admin::where('id', $id)->first();

            if (!$mod) {
                return $this->respondNotFound();
            }

            if ($mod->username === 'Admin') {
                return $this->respondForbidden('Không thể khóa tài khoản admin');
            }

            $mod->locked_until = $request->locked_until;
            $mod->save();

            return $this->respondWithData(
                [
                    'mod' => $mod,
                ]);
        }
        catch (Exception $exception) {
            return $this->respondInternalServerError($exception->getMessage());
        }
    }

    public function unlockModAccount(string $id): JsonResponse
    {
        try {
            $mod = Admin::where('id', $id)->first();

            if (!$mod) {
                return $this->respondNotFound();
            }

            $mod->locked_until = null;
            $mod->save();

            return $this->respondWithData(
                [
                    'mod' => $mod,
                ]);
        }
        catch (Exception $exception) {
            return $this->respondInternalServerError($exception->getMessage());
        }
    }
}
