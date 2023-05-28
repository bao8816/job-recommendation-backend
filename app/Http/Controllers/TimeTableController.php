<?php

namespace App\Http\Controllers;

use App\Models\TimeTable;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class TimeTableController extends ApiController
{
    public function getAllTimeTables(Request $request): JsonResponse
    {
        try {
            $count_per_page = $request->count_per_page ?? 10;

            $timeTable = TimeTable::paginate($count_per_page);

            if ($timeTable->count() === 0) {
                return $this->respondNotFound();
            }

            return $this->respondWithData([
                'time_tables' => $timeTable,
            ]);
        }
        catch (Exception $exception) {
            return $this->respondInternalServerError($exception->getMessage());
        }
    }

    public function getTimeTablesByUserId(Request $request, string $user_id): JsonResponse
    {
        try {
            $timeTable = TimeTable::where('user_id', $user_id);

            if (!$timeTable) {
                return $this->respondNotFound();
            }

            return $this->respondWithData([
                'time_tables' => $timeTable,
            ]);
        }
        catch (Exception $exception) {
            return $this->respondInternalServerError($exception->getMessage());
        }
    }

    public function getTimeTableById(Request $request, string $id): JsonResponse
    {
        try {
            $timeTable = TimeTable::where('id', $id)->first();

            if (!$timeTable) {
                return $this->respondNotFound();
            }

            return $this->respondWithData([
                'time_table' => $timeTable,
            ]);
        }
        catch (Exception $exception) {
            return $this->respondInternalServerError($exception->getMessage());
        }
    }

    public function createTimeTable(Request $request): JsonResponse
    {
        try {
            $timeTable = new TimeTable();
            $timeTable->user_id = $request->user()->id;
            $timeTable->coordinate = $request->coordinate;

            return $this->respondCreated([
                'time_table' => $timeTable,
            ]);
        }
        catch (Exception $exception) {
            return $this->respondInternalServerError($exception->getMessage());
        }
    }

    public function updateTimeTable(Request $request, string $id): JsonResponse
    {
        try {
            $timeTable = TimeTable::where('id', $id)->first();

            if (!$timeTable) {
                return $this->respondNotFound();
            }

            $timeTable->coordinate = $request->coordinate != null ? $request->coordinate : $timeTable->coordinate;

            return $this->respondWithData([
                'time_table' => $timeTable,
            ]);
        }
        catch (Exception $exception) {
            return $this->respondInternalServerError($exception->getMessage());
        }
    }

    public function deleteTimeTable(Request $request, string $id): JsonResponse
    {
        try {
            $timeTable = TimeTable::where('id', $id)->first();

            if (!$timeTable) {
                return $this->respondNotFound();
            }

            $timeTable->delete();

            return $this->respondWithData([
                'time_table' => $timeTable,
            ], 'Xoá thành công');
        }
        catch (Exception $exception) {
            return $this->respondInternalServerError($exception->getMessage());
        }
    }
}
