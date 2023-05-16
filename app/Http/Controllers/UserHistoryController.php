<?php

namespace App\Http\Controllers;

use App\Models\UserHistory;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class UserHistoryController extends ApiController
{
    public function getAllUserHistories(Request $request): JsonResponse
    {
        try {
            $count_per_page = $request->count_per_page;

            $userHistories = UserHistory::paginate($count_per_page);

            if (count($userHistories) === 0) {
                return $this->respondNotFound('No user histories found');
            }

            return $this->respondWithData(
                [
                    'userHistories' => $userHistories,
                ]
                , 'Successfully retrieved user histories');
        }
        catch (Exception $exception) {
            return $this->respondInternalServerError($exception->getMessage());
        }
    }

    public function getUserHistoriesByUserId(Request $request, string $user_id): JsonResponse
    {
        try {
            $count_per_page = $request->count_per_page;

            $userHistories = UserHistory::where('user_id', $user_id)->paginate($count_per_page);

            if (count($userHistories) === 0) {
                return $this->respondNotFound('No user histories found');
            }

            return $this->respondWithData(
                [
                    'userHistories' => $userHistories,
                ]
                , 'Successfully retrieved user histories');
        }
        catch (Exception $exception) {
            return $this->respondInternalServerError($exception->getMessage());
        }
    }

    public function getUserHistoriesByJobId(Request $request, string $job_id): JsonResponse
    {
        try {
            $count_per_page = $request->count_per_page;

            $userHistories = UserHistory::where('job_id', $job_id)->paginate($count_per_page);

            if (count($userHistories) === 0) {
                return $this->respondNotFound('No user histories found');
            }

            return $this->respondWithData(
                [
                    'userHistories' => $userHistories,
                ]
                , 'Successfully retrieved user histories');
        }
        catch (Exception $exception) {
            return $this->respondInternalServerError($exception->getMessage());
        }
    }

    public function getUserHistoryById(Request $request, string $id): JsonResponse
    {
        try {
            $userHistory = UserHistory::where('id', $id)->paginate(1);

            if (count($userHistory) === 0) {
                return $this->respondNotFound('No user history found');
            }

            return $this->respondWithData(
                [
                    'userHistory' => $userHistory,
                ]
                , 'Successfully retrieved user history');
        }
        catch (Exception $exception) {
            return $this->respondInternalServerError($exception->getMessage());
        }
    }

    public function createUserHistory(Request $request): JsonResponse
    {
        try {
            $userHistory = new UserHistory();
            $userHistory->user_id = $request->user()->id;
            $userHistory->job_id = $request->job_id;
            $userHistory->times = $request->times;
            $userHistory->save();

            return $this->respondCreated(
                [
                    'userHistory' => $userHistory,
                ]
                , 'Successfully created user history');
        }
        catch (Exception $exception) {
            return $this->respondInternalServerError($exception->getMessage());
        }
    }

    public function updateUserHistory(Request $request, string $id): JsonResponse
    {
        try {
            $userHistory = UserHistory::where('id', $id)->first();

            if ($userHistory === null) {
                return $this->respondNotFound('No user history found');
            }

            $userHistory->times = $request->times;
            $userHistory->save();

            return $this->respondWithData(
                [
                    'userHistory' => $userHistory,
                ]
                , 'Successfully updated user history');
        }
        catch (Exception $exception) {
            return $this->respondInternalServerError($exception->getMessage());
        }
    }

    public function deleteUserHistory(string $id): JsonResponse
    {
        try {
            $userHistory = UserHistory::where('id', $id)->first();

            if ($userHistory === null) {
                return $this->respondNotFound('No user history found');
            }

            $userHistory->delete();

            return $this->respondWithData(
                [
                    'userHistory' => $userHistory,
                ]
                , 'Successfully deleted user history');
        }
        catch (Exception $exception) {
            return $this->respondInternalServerError($exception->getMessage());
        }
    }
}
