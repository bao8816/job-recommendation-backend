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
            $admin = Admin::where('username', 'Admin')->paginate(1);

            if ($admin === null) {
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
            $count_per_page = $request->count_per_page;

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

    public function getModById(string $moderator_id): JsonResponse
    {
        try {
            $mod = Admin::where('_id', $moderator_id)->paginate(1);

            if ($mod === null) {
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

    public function updateMod(Request $request, $id): JsonResponse
    {
        try {
            $mod = Admin::where('_id', $id)->first();

            if ($mod === null) {
                return $this->respondNotFound();
            }

            $mod->full_name = $request->full_name;
            $mod->avatar = $request->avatar;
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

    public function deleteMod(string $id): JsonResponse
    {
        try {
            $mod = Admin::where('_id', $id)->first();

            if ($mod === null) {
                return $this->respondNotFound();
            }

            $mod->delete();

            return $this->respondWithData(
                [
                    'mod' => $mod,
                ]);
        }
        catch (Exception $exception) {
            return $this->respondInternalServerError($exception->getMessage());
        }
    }

    public function banModAccount(string $moderator_id): JsonResponse
    {
        try {
            $mod = Admin::where('_id', $moderator_id)->first();

            if ($mod === null) {
                return $this->respondNotFound();
            }

            if ($mod->username === 'Admin') {
                return $this->respondBadRequest('Không thể khóa tài khoản admin');
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

    public function unbanModAccount(string $moderator_id): JsonResponse
    {
        try {
            $mod = Admin::where('_id', $moderator_id)->first();

            if ($mod === null) {
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

    public function lockModAccount(string $moderator_id): JsonResponse
    {
        try {
            $mod = Admin::where('_id', $moderator_id)->first();

            if ($mod === null) {
                return $this->respondNotFound();
            }

            if ($mod->username === 'Admin') {
                return $this->respondBadRequest('Không thể khóa tài khoản admin');
            }

            $mod->is_locked = true;
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

    public function unlockModAccount(string $moderator_id): JsonResponse
    {
        try {
            $mod = Admin::where('_id', $moderator_id)->first();

            if ($mod === null) {
                return $this->respondNotFound();
            }

            $mod->is_locked = false;
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
