<?php

namespace App\Http\Controllers;

use App\Models\CV;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class CVController extends ApiController
{
    public function getAllCVs(Request $request): JsonResponse
    {
        try {
            $count_per_page = $request->count_per_page ?? 10;
            $order_by = $request->order_by ?? 'id';
            $order_type = $request->order_type ?? 'asc';

            $cvs = CV::filter($request, CV::query())
                ->orderBy($order_by, $order_type)
                ->paginate($count_per_page);

            if (count($cvs) === 0) {
                return $this->respondNotFound();
            }

            return $this->respondWithData(
                [
                    'cvs' => $cvs,
                ]);
        }
        catch (Exception $exception) {
            return $this->respondInternalServerError($exception->getMessage());
        }
    }

    public function getCVById(Request $request, string $id): JsonResponse
    {
        try {
            $cv = CV::where('id', $id)->first();

            if (!$cv) {
                return $this->respondNotFound();
            }

            return $this->respondWithData(
                [
                    'cv' => $cv,
                ]);
        }
        catch (Exception $exception) {
            return $this->respondInternalServerError($exception->getMessage());
        }
    }

    public function getCVsByUserId(Request $request, string $user_id): JsonResponse
    {
        try {
            $cv = CV::where('user_id', $user_id)->first();

            if (!$cv) {
                return $this->respondNotFound();
            }

            return $this->respondWithData(
                [
                    'cv' => $cv,
                ]);
        }
        catch (Exception $exception) {
            return $this->respondInternalServerError($exception->getMessage());
        }
    }

    public function createCV(Request $request): JsonResponse
    {
        try {
            $cv = new CV();
            $cv->user_id = $request->user()->id;
            $cv->cv_name = $request->cv_name;
            $cv->cv_path = $request->cv_path;
            $cv->cv_note = $request->cv_note;
            $cv->save();

            return $this->respondCreated(
                [
                    'cv' => $cv,
                ]);
        }
        catch (Exception $exception) {
            return $this->respondInternalServerError($exception->getMessage());
        }
    }

    public function updateCV(Request $request, string $id): JsonResponse
    {
        try {
            $cv = CV::where('id', $id)->first();

            if (!$cv) {
                return $this->respondNotFound();
            }

            if ($request->user()->id !== $cv->user_id) {
                return $this->respondForbidden('Bạn không có quyền chỉnh sửa CV này');
            }

            $cv->cv_name = $request->cv_name ?? $cv->cv_name;
            $cv->cv_path = $request->cv_path ?? $cv->cv_path;
            $cv->cv_note = $request->cv_note ?? $cv->cv_note;
            $cv->save();

            return $this->respondWithData(
                [
                    'cv' => $cv,
                ]);
        }
        catch (Exception $exception) {
            return $this->respondInternalServerError($exception->getMessage());
        }
    }

    public function deleteCV(Request $request, string $id): JsonResponse
    {
        try {
            $cv = CV::where('id', $id)->first();

            if (!$cv) {
                return $this->respondNotFound();
            }

            if (!$request->user()->tokenCan('mod') && $request->user()->id !== $cv->user_id) {
                return $this->respondForbidden('Bạn không có quyền xóa CV này');
            }

            $cv->delete();

            return $this->respondWithData(
                [
                    'cv' => $cv,
                ], 'Xoá thành công');
        }
        catch (Exception $exception) {
            return $this->respondInternalServerError($exception->getMessage());
        }
    }
}
