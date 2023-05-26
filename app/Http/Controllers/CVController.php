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
            $count_per_page = $request->count_per_page;

            $cvs = CV::paginate($count_per_page);

            if (count($cvs) === 0) {
                return $this->respondNotFound('No cvs found');
            }

            return $this->respondWithData(
                [
                    'cvs' => $cvs,
                ]
                , 'Successfully retrieved cvs');
        }
        catch (Exception $exception) {
            return $this->respondInternalServerError($exception->getMessage());
        }
    }

    public function getCVsByUserId(Request $request, string $user_id): JsonResponse
    {
        try {
            $count_per_page = $request->count_per_page;

            $cvs = CV::where('user_id', $user_id)->paginate($count_per_page);

            if (count($cvs) === 0) {
                return $this->respondNotFound('No cvs found');
            }

            return $this->respondWithData(
                [
                    'cvs' => $cvs,
                ]
                , 'Successfully retrieved cvs');
        }
        catch (Exception $exception) {
            return $this->respondInternalServerError($exception->getMessage());
        }
    }

    public function getCVById(Request $request, string $id): JsonResponse
    {
        try {
            $cv = CV::where('id', $id)->paginate(1);

            if (count($cv) === 0) {
                return $this->respondNotFound('No cv found');
            }

            return $this->respondWithData(
                [
                    'cv' => $cv,
                ]
                , 'Successfully retrieved cv');
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
            $cv->cv_path = $request->cv_path;
            $cv->save();

            return $this->respondWithData(
                [
                    'cv' => $cv,
                ]
                , 'Successfully created cv');
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
                return $this->respondNotFound('No cv found');
            }

            $cv->cv_path = $request->cv_path;
            $cv->save();

            return $this->respondWithData(
                [
                    'cv' => $cv,
                ]
                , 'Successfully updated cv');
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
                return $this->respondNotFound('No cv found');
            }

            $cv->delete();

            return $this->respondWithData(
                [
                    'cv' => $cv,
                ]
                , 'Successfully deleted cv');
        }
        catch (Exception $exception) {
            return $this->respondInternalServerError($exception->getMessage());
        }
    }
}
