<?php

namespace App\Http\Controllers;

use App\Models\JobSkill;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class JobSkillController extends ApiController
{
    public function getAllJobSkills(Request $request): JsonResponse
    {
        try {
            $count_per_page = $request->count_per_page;

            $jobSkills = JobSkill::paginate($count_per_page);

            if (count($jobSkills) === 0) {
                return $this->respondNotFound('No job skills found');
            }

            return $this->respondWithData(
                [
                    'jobSkills' => $jobSkills,
                ]
                , 'Successfully retrieved job skills');
        }
        catch (Exception $exception) {
            return $this->respondInternalServerError($exception->getMessage());
        }
    }

    public function getJobSkillsByJobId(Request $request, string $job_id): JsonResponse
    {
        try {
            $count_per_page = $request->count_per_page;

            $jobSkills = JobSkill::where('job_id', $job_id)->paginate($count_per_page);

            if (count($jobSkills) === 0) {
                return $this->respondNotFound('No job skills found');
            }

            return $this->respondWithData(
                [
                    'jobSkills' => $jobSkills,
                ]
                , 'Successfully retrieved job skills');
        }
        catch (Exception $exception) {
            return $this->respondInternalServerError($exception->getMessage());
        }
    }

    public function getJobSkillById(Request $request, string $id): JsonResponse
    {
        try {
            $jobSkill = JobSkill::where('id', $id)->paginate(1);

            if (!isset($jobSkill)) {
                return $this->respondNotFound('Job skill not found');
            }

            return $this->respondWithData(
                [
                    'jobSkill' => $jobSkill,
                ]
                , 'Successfully retrieved job skill');
        }
        catch (Exception $exception) {
            return $this->respondInternalServerError($exception->getMessage());
        }
    }
}
