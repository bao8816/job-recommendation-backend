<?php

namespace App\Http\Controllers;

use App\Models\CompanyVerification;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class CompanyVerificationController extends ApiController
{
    public function getCompanyVerifications(Request $request): JsonResponse
    {
        try {
            $count_per_page = $request->count_per_page ?? 10;
            $order_by = $request->order_by ?? 'id';
            $order_type = $request->order_type ?? 'asc';

            $company_vevrifications = CompanyVerification::filter($request, CompanyVerification::query())
                ->orderBy($order_by, $order_type)
                ->paginate($count_per_page);

            if (count($company_vevrifications) === 0) {
                return $this->respondNotFound();
            }

            return $this->respondWithData(
                [
                    'company_vevrifications' => $company_vevrifications,
                ]);
        }
        catch (Exception $exception) {
            return $this->respondInternalServerError($exception->getMessage());
        }
    }

    public function getCompanyVerificationById(Request $request, string $id): JsonResponse
    {
        try {
            $company_verification = CompanyVerification::where('id', $id)->first();

            if (!$company_verification) {
                return $this->respondNotFound();
            }

            return $this->respondWithData(
                [
                    'company_verification' => $company_verification,
                ]);
        }
        catch (Exception $exception) {
            return $this->respondInternalServerError($exception->getMessage());
        }
    }

    public function createCompanyVerification(Request $request): JsonResponse
    {
        try {
            $company_verification = new CompanyVerification();
            $company_verification->company_id = $request->company_id;
            $company_verification->verification_url = $request->verification_url;
            $company_verification->save();

            return $this->respondCreated(
                [
                    'company_verification' => $company_verification,
                ]);
        }
        catch (Exception $exception) {
            return $this->respondInternalServerError($exception->getMessage());
        }
    }

    public function approveCompanyVerification(Request $request, string $id): JsonResponse
    {
        try {
            $company_verification = CompanyVerification::where('id', $id)->first();

            if (!$company_verification) {
                return $this->respondNotFound();
            }

            $company_verification->status = 'Hợp lệ';
            $company_verification->save();

            return $this->respondWithData(
                [
                    'company_verification' => $company_verification,
                ]);
        }
        catch (Exception $exception) {
            return $this->respondInternalServerError($exception->getMessage());
        }
    }

    public function rejectCompanyVerification(Request $request, string $id): JsonResponse
    {
        try {
            $company_verification = CompanyVerification::where('id', $id)->first();

            if (!$company_verification) {
                return $this->respondNotFound();
            }

            $company_verification->status = 'Không hợp lệ';
            $company_verification->save();

            return $this->respondWithData(
                [
                    'company_verification' => $company_verification,
                ]);
        }
        catch (Exception $exception) {
            return $this->respondInternalServerError($exception->getMessage());
        }
    }

    public function deleteCompanyVerification(Request $request, string $id): JsonResponse
    {
        try {
            $company_verification = CompanyVerification::where('id', $id)->first();

            if (!$company_verification) {
                return $this->respondNotFound();
            }

            $company_verification->delete();

            return $this->respondWithData(
                [
                    'company_verification' => $company_verification,
                ], 'Xóa thành công');
        }
        catch (Exception $exception) {
            return $this->respondInternalServerError($exception->getMessage());
        }
    }
}
