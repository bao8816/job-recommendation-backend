<?php

namespace App\Http\Controllers;

use App\Models\EmployerAccount;
use App\Models\EmployerProfile;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class EmployerAccountController extends ApiController
{
    public function getEmployerAccounts(Request $request): JsonResponse
    {
        try {
            $count_per_page = $request->count_per_page ?? 10;
            $order_by = $request->order_by ?? 'id';
            $order_type = $request->order_type ?? 'asc';

            $employer_accounts = EmployerAccount::filter($request, EmployerAccount::query())
                ->with('profile')
                ->orderBy($order_by, $order_type)
                ->paginate($count_per_page);

            if (count($employer_accounts) === 0) {
                return $this->respondNotFound();
            }

            return $this->respondWithData(
                [
                    'employer_accounts' => $employer_accounts,
                ]);
        }
        catch (Exception $exception) {
            return $this->respondInternalServerError($exception->getMessage());
        }
    }

    public function getEmployerAccountById(Request $request, string $id): JsonResponse
    {
        try {
            $employer_account = EmployerAccount::where('id', $id)->with('profile')
                ->first();

            if (!$employer_account) {
                return $this->respondNotFound();
            }

            return $this->respondWithData(
                [
                    'employer_account' => $employer_account,
                ]);
        }
        catch (Exception $exception) {
            return $this->respondInternalServerError($exception->getMessage());
        }
    }

    public function createEmployerAccount(Request $request): JsonResponse
    {
        try {
            $username = $request->username;
            $password = $request->password;
            $salt_password = $password . env('PASSWORD_SALT');

            if (EmployerAccount::where('username', $username)->first()) {
                return $this->respondBadRequest('Tên đăng nhập đã tồn tại');
            }

            $hashed_password = Hash::make($salt_password);

            $employer_account = new EmployerAccount();
            $employer_account->username = $username;
            $employer_account->password = $hashed_password;
            $employer_account->save();

            $employer_profile = new EmployerProfile();
            $employer_profile->id = $employer_account->id;
            $employer_profile->company_id = $request->company_id ?? $request->user()->id;
            $employer_profile->full_name = 'Họ và tên';
            $employer_profile->save();

            return $this->respondCreated(
                [
                    'employer_account' => $employer_account,
                ]);
        }
        catch (Exception $exception) {
            return $this->respondInternalServerError($exception->getMessage());
        }
    }

    public function updatePassword(Request $request): JsonResponse
    {
        try {
            $employer_account = EmployerAccount::where('id', $request->user()->id)->first();

            if (!$employer_account) {
                return $this->respondNotFound();
            }

            $current_password = $request->current_password;
            $new_password = $request->new_password;
            $confirm_password = $request->confirm_password;
            $salt_password = $current_password . env('PASSWORD_SALT');

            if (!Hash::check($salt_password, $employer_account->password)) {
                return $this->respondBadRequest('Mật khẩu hiện tại không đúng');
            }

            if ($new_password !== $confirm_password) {
                return $this->respondBadRequest('Mật khẩu mới không khớp');
            }

            $employer_account->password = Hash::make($new_password . env('PASSWORD_SALT'));
            $employer_account->save();

            return $this->respondWithData(
                [
                    'employer_account' => $employer_account,
                ]);
        }
        catch (Exception $exception) {
            return $this->respondInternalServerError($exception->getMessage());
        }
    }

    public function banEmployerAccount(Request $request, string $id): JsonResponse
    {
        try {
            $employer_account = EmployerAccount::where('id', $id)->first();

            if (!$employer_account) {
                return $this->respondNotFound();
            }

            $employer_account->is_banned = true;
            $employer_account->save();

            return $this->respondWithData(
                [
                    'employer_account' => $employer_account,
                ]);
        }
        catch (Exception $exception) {
            return $this->respondInternalServerError($exception->getMessage());
        }
    }

    public function unbanEmployerAccount(Request $request, string $id): JsonResponse
    {
        try {
            $employer_account = EmployerAccount::where('id', $id)->first();

            if (!$employer_account) {
                return $this->respondNotFound();
            }

            $employer_account->is_banned = false;
            $employer_account->save();

            return $this->respondWithData(
                [
                    'employer_account' => $employer_account,
                ]);
        }
        catch (Exception $exception) {
            return $this->respondInternalServerError($exception->getMessage());
        }
    }

    public function lockEmployerAccount(Request $request, string $id): JsonResponse
    {
        try {
            $employer_account = EmployerAccount::where('id', $id)->first();

            if (!$employer_account) {
                return $this->respondNotFound();
            }

            $employer_account->locked_until = $request->locked_until;
            $employer_account->save();

            return $this->respondWithData(
                [
                    'employer_account' => $employer_account,
                ]);
        }
        catch (Exception $exception) {
            return $this->respondInternalServerError($exception->getMessage());
        }
    }

    public function unlockEmployerAccount(Request $request, string $id): JsonResponse
    {
        try {
            $employer_account = EmployerAccount::where('id', $id)->first();

            if (!$employer_account) {
                return $this->respondNotFound();
            }

            $employer_account->locked_until = null;
            $employer_account->save();

            return $this->respondWithData(
                [
                    'employer_account' => $employer_account,
                ]);
        }
        catch (Exception $exception) {
            return $this->respondInternalServerError($exception->getMessage());
        }
    }

    public function deleteEmployerAccount(Request $request, string $id): JsonResponse
    {
        try {
            $employer_account = EmployerAccount::where('id', $id)->first();
            $profile = EmployerProfile::where('id', $id)->first();

            if (!$employer_account || !$profile) {
                return $this->respondNotFound();
            }

            $employer_account->delete();
            $profile->delete();

            return $this->respondWithData(
                [
                    'employer_account' => $employer_account,
                    'profile' => $profile,
                ], 'Xoá thành công');
        }
        catch (Exception $exception) {
            return $this->respondInternalServerError($exception->getMessage());
        }
    }
}
