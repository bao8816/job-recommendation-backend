<?php

namespace App\Http\Controllers;

use App\Models\EmployerProfile;
use App\Models\Job;
use Carbon\Carbon;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class JobController extends ApiController
{
    /**
     *  @OA\Get(
     *      path="/api/jobs",
     *      summary="Get all jobs",
     *      tags={"Jobs"},
     *      @OA\Parameter(
     *          name="count_per_page",
     *          in="query",
     *          description="Number of jobs per page",
     *          required=false
     *      ),
     *      @OA\Parameter(
     *          name="Accept",
     *          in="header",
     *          description="application/json",
     *          required=false
     *      ),
     *      @OA\Response(
     *          response=200,
     *          description="Successfully retrieved jobs",
     *          @OA\JsonContent(
     *              example=
    {
    "error": false,
    "message": "Xử lí thành công",
    "data": {
    "job": {
    "current_page": 1,
    "data": {
    {
    "id": 1,
    "employer_id": 4,
    "title": "Trợ Lý Trưởng Phòng Xuất Nhập Khẩu",
    "description": "- Tư vấn tính năng, tiện ích và bán các sản phẩm điện thoại, máy tính bảng, Macbook tại Showroom. Không phải đi thị trường.- Phối hợp cùng team Marketing lên kế hoạch triển khai các Event hàng Tuần, Tháng và chương trình Chăm sóc sau Bán Hàng.- Các công việc khác được giao từ Quản lý. ",
    "benefit": "- Lương thỏa thuận (Tùy theo năng lực và kinh nghiệm). Ngoài ra còn chính sách thưởng hiệu quả làm việc.- Thưởng đột xuất theo thành tích đặc biệt và hoặc các sáng kiến cải tiến trong công việc.- Được hưởng đầy đủ quyền lợi của người lao động theo luật hiện hành (Bảo hiểm xã hội, Bảo hiểm y tế).- Được hưởng chế độ du lịch cùng Team, thưởng lễ Tết, thưởng theo doanh số kinh doanh của Công Ty.- Được tham gia đào tạo nâng cao chuyên sâu, chuyên môn và kỹ năng.- Cơ hội phát triển bản thân và thăng tiến trong tổ chức.- Môi trường làm việc năng động, thân thiện. Có cơ hội làm việc với nhiều đối tác lớn, uy tín.- Được hưởng năng suất hàng quý và tăng lương định kỳ. ",
    "requirement": "- Trợ lý Trưởng phòng Xuất nhập khẩu tối thiểu phải tốt nghiệp cử nhân ngành Kinh tế, Ngoại thương hoặc Kinh doanh quốc tế ngành Xuất nhập khẩu hoặc có kinh nghiệm từ 2 năm trở lên trong lĩnh vực này ở vị trí tương đương. Hoặc là dược sĩ và có kinh nghiệm làm việc ở vị trí tương đương.- Ưu tiên các ứng viên đã làm việc hoặc tiếp xúc với môi trường làm việc trong lĩnh vực dược phẩm (background kinh tế) hoặc công ty xuất nhật khẩu (background dược).- Trường hợp không đáp ứng toàn bộ MTCV và yêu cầu công việc nêu trên vẫn sẽ được đào tạo nhưng cần có ý chí mạnh mẽ, quyết tâm học việc, sự tập trung và khả năng chịu áp lực cao.- Có khả năng đàm phán và giao tiếp tốt, chịu áp lực công việc cao.- Có năng lực sắp xếp công việc, lên kế hoạch, báo cáo.- Có tiềm năng và hướng đến vị trí quản lý, điều hành, đưa ra được các đề xuất giúp phát triển phòng Xuất nhập khẩu tiến xa hơn và gắn với chiến lược công ty.- Có khả năng gắn kết, quan tâm, đánh giá và phát triển nguồn nhân lực trong phòng ban phục vụ cho sự phát triển của bản thân mỗi người, công việc và công ty theo giá trị cốt lõi của công ty.- Có kỹ năng sử dụng tiếng Anh, đặc biệt là kỹ năng viết tốt.- Có kỹ năng phân tích, tổng hợp tốt, đánh giá và đề xuất, tham mưu cho Hội đồng thành viên.- Có kỹ năng thuyết trình trước đám đông một cách rõ ràng, dễ hiểu, đạt được hiệu quả cao nhất.- Quyết đoán trong công việc, dám nghĩ dám làm, dám chịu trách nhiệm.- Có phẩm chất đạo đức tốt và trung thực. ",
    "min_salary": -1,
    "max_salary": -1,
    "recruit_num": 1,
    "position": "Toàn thời gian",
    "year_of_experience": "2",
    "deadline": "1970-01-01",
    "job_locations": {
    {
    "id": 1,
    "job_id": 1,
    "location": "Hồ Chí Minh: 72 Bình Giã"
    }
    },
    "job_skills": {
    {
    "id": 1,
    "job_id": 1,
    "skill": "PowerPoint"
    },
    {
    "id": 2,
    "job_id": 1,
    "skill": "Microsoft Excel"
    },
    {
    "id": 3,
    "job_id": 1,
    "skill": "Microsoft Word"
    }
    },
    "job_types": {
    {
    "id": 1,
    "job_id": 1,
    "type": "Nhân viên"
    }
    }
    }
    },
    "first_page_url": "http://localhost:8000/api/jobs/1?page=1",
    "from": 1,
    "last_page": 1,
    "last_page_url": "http://localhost:8000/api/jobs/1?page=1",
    "links": {
    {
    "url": null,
    "label": "&laquo; Previous",
    "active": false
    },
    {
    "url": "http://localhost:8000/api/jobs/1?page=1",
    "label": "1",
    "active": true
    },
    {
    "url": null,
    "label": "Next &raquo;",
    "active": false
    }
    },
    "next_page_url": null,
    "path": "http://localhost:8000/api/jobs/1",
    "per_page": 1,
    "prev_page_url": null,
    "to": 1,
    "total": 1
    }
    },
    "status_code": 200
    }
     *          )
     *      ),
     *      @OA\Response(
     *          response=404,
     *          description="No jobs found",
     *          ref="#/components/responses/NotFound"
     *      ),
     *  )
     */
    public function getAllJobs(Request $request): JsonResponse
    {
        try {
            $count_per_page = $request->count_per_page;

            $jobs = Job::with('job_locations', 'job_skills', 'job_types')->paginate($count_per_page);

            if (count($jobs) === 0) {
                return $this->respondNotFound();
            }

            return $this->respondWithData(
                [
                    'jobs' => $jobs,
                ]);
        }
        catch (Exception $exception) {
            return $this->respondInternalServerError($exception->getMessage());
        }
    }

    /**
     *  @OA\Get(
     *      path="/api/jobs/available",
     *      tags={"Jobs"},
     *      summary="Get all jobs available",
     *      @OA\Parameter(
     *          name="count_per_page",
     *          in="query",
     *          description="Number of jobs per page",
     *          required=false
     *      ),
     *      @OA\Parameter(
     *          name="Accept",
     *          in="header",
     *          description="application/json",
     *          required=false
     *      ),
     *      @OA\Response(
     *          response=200,
     *          description="Successfully retrieved jobs",
     *          @OA\JsonContent(
     *              example=
    {
    "error": false,
    "message": "Xử lí thành công",
    "data": {
    "job": {
    "current_page": 1,
    "data": {
    {
    "id": 1,
    "employer_id": 4,
    "title": "Trợ Lý Trưởng Phòng Xuất Nhập Khẩu",
    "description": "- Tư vấn tính năng, tiện ích và bán các sản phẩm điện thoại, máy tính bảng, Macbook tại Showroom. Không phải đi thị trường.- Phối hợp cùng team Marketing lên kế hoạch triển khai các Event hàng Tuần, Tháng và chương trình Chăm sóc sau Bán Hàng.- Các công việc khác được giao từ Quản lý. ",
    "benefit": "- Lương thỏa thuận (Tùy theo năng lực và kinh nghiệm). Ngoài ra còn chính sách thưởng hiệu quả làm việc.- Thưởng đột xuất theo thành tích đặc biệt và hoặc các sáng kiến cải tiến trong công việc.- Được hưởng đầy đủ quyền lợi của người lao động theo luật hiện hành (Bảo hiểm xã hội, Bảo hiểm y tế).- Được hưởng chế độ du lịch cùng Team, thưởng lễ Tết, thưởng theo doanh số kinh doanh của Công Ty.- Được tham gia đào tạo nâng cao chuyên sâu, chuyên môn và kỹ năng.- Cơ hội phát triển bản thân và thăng tiến trong tổ chức.- Môi trường làm việc năng động, thân thiện. Có cơ hội làm việc với nhiều đối tác lớn, uy tín.- Được hưởng năng suất hàng quý và tăng lương định kỳ. ",
    "requirement": "- Trợ lý Trưởng phòng Xuất nhập khẩu tối thiểu phải tốt nghiệp cử nhân ngành Kinh tế, Ngoại thương hoặc Kinh doanh quốc tế ngành Xuất nhập khẩu hoặc có kinh nghiệm từ 2 năm trở lên trong lĩnh vực này ở vị trí tương đương. Hoặc là dược sĩ và có kinh nghiệm làm việc ở vị trí tương đương.- Ưu tiên các ứng viên đã làm việc hoặc tiếp xúc với môi trường làm việc trong lĩnh vực dược phẩm (background kinh tế) hoặc công ty xuất nhật khẩu (background dược).- Trường hợp không đáp ứng toàn bộ MTCV và yêu cầu công việc nêu trên vẫn sẽ được đào tạo nhưng cần có ý chí mạnh mẽ, quyết tâm học việc, sự tập trung và khả năng chịu áp lực cao.- Có khả năng đàm phán và giao tiếp tốt, chịu áp lực công việc cao.- Có năng lực sắp xếp công việc, lên kế hoạch, báo cáo.- Có tiềm năng và hướng đến vị trí quản lý, điều hành, đưa ra được các đề xuất giúp phát triển phòng Xuất nhập khẩu tiến xa hơn và gắn với chiến lược công ty.- Có khả năng gắn kết, quan tâm, đánh giá và phát triển nguồn nhân lực trong phòng ban phục vụ cho sự phát triển của bản thân mỗi người, công việc và công ty theo giá trị cốt lõi của công ty.- Có kỹ năng sử dụng tiếng Anh, đặc biệt là kỹ năng viết tốt.- Có kỹ năng phân tích, tổng hợp tốt, đánh giá và đề xuất, tham mưu cho Hội đồng thành viên.- Có kỹ năng thuyết trình trước đám đông một cách rõ ràng, dễ hiểu, đạt được hiệu quả cao nhất.- Quyết đoán trong công việc, dám nghĩ dám làm, dám chịu trách nhiệm.- Có phẩm chất đạo đức tốt và trung thực. ",
    "min_salary": -1,
    "max_salary": -1,
    "recruit_num": 1,
    "position": "Toàn thời gian",
    "year_of_experience": "2",
    "deadline": "1970-01-01",
    "job_locations": {
    {
    "id": 1,
    "job_id": 1,
    "location": "Hồ Chí Minh: 72 Bình Giã"
    }
    },
    "job_skills": {
    {
    "id": 1,
    "job_id": 1,
    "skill": "PowerPoint"
    },
    {
    "id": 2,
    "job_id": 1,
    "skill": "Microsoft Excel"
    },
    {
    "id": 3,
    "job_id": 1,
    "skill": "Microsoft Word"
    }
    },
    "job_types": {
    {
    "id": 1,
    "job_id": 1,
    "type": "Nhân viên"
    }
    }
    }
    },
    "first_page_url": "http://localhost:8000/api/jobs/1?page=1",
    "from": 1,
    "last_page": 1,
    "last_page_url": "http://localhost:8000/api/jobs/1?page=1",
    "links": {
    {
    "url": null,
    "label": "&laquo; Previous",
    "active": false
    },
    {
    "url": "http://localhost:8000/api/jobs/1?page=1",
    "label": "1",
    "active": true
    },
    {
    "url": null,
    "label": "Next &raquo;",
    "active": false
    }
    },
    "next_page_url": null,
    "path": "http://localhost:8000/api/jobs/1",
    "per_page": 1,
    "prev_page_url": null,
    "to": 1,
    "total": 1
    }
    },
    "status_code": 200
    }
     *          ),
     *      ),
     *      @OA\Response(
     *          response=404,
     *          description="No jobs found",
     *          ref="#/components/responses/NotFound"
     *      ),
     *  )
     */
    public function getAvailableJobs(Request $request): JsonResponse
    {
        try {
            $count_per_page = $request->count_per_page;

            $jobs = Job::with('job_locations', 'job_skills', 'job_types')->where('deadline', '>', Carbon::now())->paginate($count_per_page);

            if (count($jobs) === 0) {
                return $this->respondNotFound();
            }

            return $this->respondWithData(
                [
                    'jobs' => $jobs,
                ]);
        }
        catch (Exception $exception) {
            return $this->respondInternalServerError($exception->getMessage());
        }
    }

    /**
     *  @OA\Get(
     *      path="/api/jobs/company/{company_id}",
     *      tags={"Jobs"},
     *      summary="Get all jobs by company id",
     *      @OA\Parameter(
     *          name="company_id",
     *          description="Company id",
     *          required=true,
     *          in="path",
     *      ),
     *      @OA\Parameter(
     *          name="count_per_page",
     *          in="query",
     *          description="Number of jobs per page",
     *          required=false
     *      ),
     *      @OA\Parameter(
     *          name="Accept",
     *          in="header",
     *          description="application/json",
     *          required=false
     *      ),
     *      @OA\Response(
     *          response=200,
     *          description="Successfully retrieved jobs",
     *          @OA\JsonContent(
     *              example={
    "error": false,
    "message": "Xử lí thành công",
    "data": {
    "jobs": {
    "current_page": 1,
    "data": {
    {
    "id": 41,
    "employer_id": 10,
    "title": "Nhân Viên Telesale",
    "description": "Tiếp nhận thông tin từ chuyên viên thiết kế Heating, Ventilating, and Air Conditioning, nghe hướng dẫn thực hiện công việc từ Chuyên viên, Chủ trì, hoặc Trưởng nhóm, cụ thể:Vẽ hệ thống mặt bằng và sơ đồ single-split trong căn hộ mẫu, điển hình, vẽ thực hiện theo mẫu đã thiết kế sẵn bao gồm:- Điều hòa âm trần nối ống gió trong căn hộ (vẽ ống mềm và phụ kiện)- Dàn lạnh treo tường trong căn hộ- Dàn lạnh cassetle trong căn hộ- Hệ thống thoát nước ngưng- Hệ thống ống gas- Hệ thống thoát mùi wc- Hệ thống thoát khói bếp- Hệ thống cấp gió tươi ",
    "benefit": "Được làm việc trong môi trường trẻ trung năng độngChưa có kinh nghiệm sẽ được đào tạoĐược hưởng nhiều chế độ + thưởng hấp dẫn ",
    "requirement": "Sinh viên các trường Đại học, Cao đẳng hoặc Trung cấp tại Hà NộiCó laptop cá nhânCó khả năng giao tiếp tốt, linh hoạt, giọng nói dễ nghe, không nói ngọng. ",
    "min_salary": -1,
    "max_salary": -1,
    "recruit_num": 4,
    "position": "Bán thời gian",
    "year_of_experience": "0",
    "deadline": "1970-01-01",
    "job_locations": {
    {
    "id": 47,
    "job_id": 41,
    "location": "Hà Tĩnh: Số 7"
    }
    },
    "job_skills": {
    {
    "id": 114,
    "job_id": 41,
    "skill": "IT Helpdesk"
    }
    },
    "job_types": {
    {
    "id": 42,
    "job_id": 41,
    "type": "Thực tập sinh"
    }
    }
    },
    {
    "id": 9,
    "employer_id": 18,
    "title": "Nhân Viên Kinh Doanh Ngành Vận Tải Đường Bộ",
    "description": "- Quản lý tài khoản bán hàng online của công ty trên sàn thương mại điện tử Shopee- Đăng & tối ưu sản phẩm chuẩn SEO- Trang trí gian hàng, cập nhật thông tin gian hàng và theo dõi lượng truy cập để tối ưu hóa độ hiển thị.- Theo dõi các chương trình khuyến mãi và đưa ra các chương trình marketing phù hợp để thúc đẩy tăng doanh số bán hàng.- Tổng hợp, phân tích, báo cáo kết quả kinh doanh theo từng chương trình, từng quý.- Thu thập, phân tích các dữ liệu liênquan đến xu hướng của thị trường nhằm có những kế hoạch, thích nghi và tối đa hóa tiềm năng bán hàng. ",
    "benefit": "Lương thỏa thuận theo năng lựcĐóng BHXH, BHYT đầy đủ theo quy định của nhà nước.Tham gia các hoạt động teambuilding, du lịch hàng năm cùng công tyMôi trường làm việc trẻ, năng động, chuyên nghiệp ",
    "requirement": "Tốt nghiệp cao đẳng , đại học có liên quan : Giao thông vận tải , Quản trị kinh doanh , ......Yêu cầu Excel thông thạo.Có kỹ năng tổ chức và quản lý tốt, nắm bắt tâm lý và khả năng của các lái xe, điều hành, bố trí, phân công, theo dõi lộ trình lái xe hợp lý nhất.Khả năng xử lý tình huống phát sinh trong quá trình vận chuyển như: Hỏng xe, tai nạn, hàng hóa…Kỹ năng phân tích, thuyết trình & báo cáo tốt.Trung thực, khách quan, có tinh thần học hỏi, cầu tiến và trách nhiệm cao.Chịu được áp lực công việc cao, thời gian làm việc áp lực. ",
    "min_salary": -1,
    "max_salary": -1,
    "recruit_num": 2,
    "position": "Bán thời gian",
    "year_of_experience": "2",
    "deadline": "1970-01-01",
    "job_locations": {
    {
    "id": 12,
    "job_id": 9,
    "location": "Hồ Chí Minh: 79 Tô Ký"
    },
    {
    "id": 13,
    "job_id": 9,
    "location": "Hồ Chí Minh: Cầu Vượt Quang Trung"
    }
    },
    "job_skills": {
    {
    "id": 24,
    "job_id": 9,
    "skill": "Word"
    },
    {
    "id": 25,
    "job_id": 9,
    "skill": "PowerPoint"
    },
    {
    "id": 26,
    "job_id": 9,
    "skill": "Excel cơ bản"
    }
    },
    "job_types": {
    {
    "id": 9,
    "job_id": 9,
    "type": "Trưởng nhóm"
    }
    }
    }
    },
    "first_page_url": "http://localhost:8000/api/jobs/company/2?page=1",
    "from": 1,
    "last_page": 3,
    "last_page_url": "http://localhost:8000/api/jobs/company/2?page=3",
    "links": {
    {
    "url": null,
    "label": "&laquo; Previous",
    "active": false
    },
    {
    "url": "http://localhost:8000/api/jobs/company/2?page=1",
    "label": "1",
    "active": true
    },
    {
    "url": "http://localhost:8000/api/jobs/company/2?page=2",
    "label": "2",
    "active": false
    },
    {
    "url": "http://localhost:8000/api/jobs/company/2?page=3",
    "label": "3",
    "active": false
    },
    {
    "url": "http://localhost:8000/api/jobs/company/2?page=2",
    "label": "Next &raquo;",
    "active": false
    }
    },
    "next_page_url": "http://localhost:8000/api/jobs/company/2?page=2",
    "path": "http://localhost:8000/api/jobs/company/2",
    "per_page": 2,
    "prev_page_url": null,
    "to": 2,
    "total": 5
    }
    },
    "status_code": 200
     *              }
     *          ),
     *      ),
     *      @OA\Response(
     *          response=404,
     *          description="Not found",
     *          ref="#/components/responses/NotFound"
     *      ),
     *  )
     */
    public function getJobsByCompanyId(Request $request, string $company_id): JsonResponse
    {
        try {
            $count_per_page = $request->count_per_page;

            // get all employer profiles with company_id = $company_id, then get all jobs with employer_id = $employer_profile->id
            $jobs = Job::whereHas('employer_profile', function ($query) use ($company_id) {
                $query->where('company_id', $company_id);
            })->with('job_locations', 'job_skills', 'job_types')->paginate($count_per_page);

            if (count($jobs) === 0) {
                return $this->respondNotFound();
            }

            return $this->respondWithData(
                [
                    'jobs' => $jobs,
                ]);
        }
        catch (Exception $exception) {
            return $this->respondInternalServerError($exception->getMessage());
        }
    }

    /**
     *  @OA\Get(
     *      path="/api/jobs/employer/{employer_id}",
     *      tags={"Jobs"},
     *      summary="Get jobs by employer id",
     *      @OA\Parameter(
     *          name="employer_id",
     *          description="Employer id",
     *          required=true,
     *          in="path",
     *      ),
     *      @OA\Parameter(
     *          name="count_per_page",
     *          in="query",
     *          description="Number of jobs per page",
     *          required=false
     *      ),
     *      @OA\Parameter(
     *          name="Accept",
     *          in="header",
     *          description="application/json",
     *          required=false
     *      ),
     *      @OA\Response(
     *          response=200,
     *          description="Jobs retrieved successfully",
     *          @OA\JsonContent(
     *              example={
    "error": false,
    "message": "Xử lí thành công",
    "data": {
    "jobs": {
    "current_page": 1,
    "data": {
    {
    "id": 35,
    "employer_id": 2,
    "title": "Stock Controlling Supervisor",
    "description": "Phân tích đối thủ cạnh tranh, khảo sát từ khóa, lập kế hoạch SEO cho dự án website.Đề xuất kế hoạch và thực hiện tối ưu onpage, audit site, offpage …. để tăng thứ hạng website.Theo dõi sự phát triển của website, hiệu quả chiến dịch SEO, đề xuất phương án cải thiện nếu cần.Set up hệ thống vệ tinh và quản trị website vệ tinh.Phối hợp triển khai các chiến dịch, kế hoạch quảng cáo trên hệ thống nền tảng Online.Lập báo cáo thường kỳ theo tháng về kết quả SEO. ",
    "benefit": "- Mon - Fri, off Sat & Sunday- Meal allowance: 50,000 VND/working day- SHUI on full salary package- 13rd salary ++- Add-on health insurance PTI- Dynamic working environment- Open for career Path ",
    "requirement": "Bachelor Degree – Business Administration, Economics, Logistic2 years working experience in the similar position (especially Retail field)Strong communication, hardworking and carefulStrong analytical ability and good in data/ figures.Good at MS OfficeEnglish communication ",
    "min_salary": -1,
    "max_salary": -1,
    "recruit_num": 1,
    "position": "Toàn thời gian",
    "year_of_experience": "2",
    "deadline": "1970-01-01",
    "job_locations": {
    {
    "id": 41,
    "job_id": 35,
    "location": "Hồ Chí Minh: 2b Phan Thúc Duyện phường 4 Tân Bình HCM"
    }
    },
    "job_skills": {
    {
    "id": 96,
    "job_id": 35,
    "skill": "Data Analysis"
    }
    },
    "job_types": {
    {
    "id": 36,
    "job_id": 35,
    "type": "Nhân viên"
    }
    }
    },
    {
    "id": 36,
    "employer_id": 2,
    "title": "Đào Tạo Quản Lý Canteen Tập Sự (8-10 Triệu)",
    "description": "- Chịu trách nhiệm phát triển các Khách hàng mới là đại lý, cửa hàng tạp hóa, siêu thị tiện lợi- Thực hiện việc đi thăm, khảo sát các đại lý hàng ngày tại khu vực phụ trách bằng xe máy.- Đảm bảo đầy đủ lượt khảo sát theo chỉ tiêu do Quản lý phát triển thị trường giao cho.- Truyền tải và đóng góp các ý kiến phản hồi để ngày càng hoàn thiện sản phẩm cho Khách hàng. ",
    "benefit": "Phúc lợi, chế độ đầy đủ (BHXH, thưởng, trợ cấp, phép năm,...)Miễn phí cơm trưaCơ hội tham gia các khóa đào tạo quản lýLương tháng 13/ Review lương hằng năm ",
    "requirement": "- Tốt nghiệp Đại học, Cao đẳng chuyên ngành Công nghệ thực phẩm, Quản trị kinh doanh, Quản lý công nghiệp.- Độ tuổi từ 22 – 25- Nhận đào tạo không cần kinh nghiệm- Thành thạo vi tính văn phòng, khả năng tổng hợp, thống kê, và báo cáo số liệu.- Làm việc tại các cơ sở canteen/ nhà máy ",
    "min_salary": -1,
    "max_salary": -1,
    "recruit_num": 10,
    "position": "Toàn thời gian",
    "year_of_experience": "<1",
    "deadline": "1970-01-01",
    "job_locations": {
    {
    "id": 42,
    "job_id": 36,
    "location": "Hà Nội: Địa điểm kinh doanh khu vực Đống Đa",
    }
    },
    "job_skills": {
    {
    "id": 97,
    "job_id": 36,
    "skill": "Kỹ năng giao tiếp"
    },
    {
    "id": 98,
    "job_id": 36,
    "skill": "Tin học văn phòng"
    },
    {
    "id": 99,
    "job_id": 36,
    "skill": "Xử lý tình huống"
    },
    {
    "id": 100,
    "job_id": 36,
    "skill": "Kỹ năng quản lý công việc"
    }
    },
    "job_types": {
    {
    "id": 37,
    "job_id": 36,
    "type": "Nhân viên"
    }
    }
    }
    },
    "first_page_url": "http://localhost:8000/api/jobs/employer/2?page=1",
    "from": 1,
    "last_page": 1,
    "last_page_url": "http://localhost:8000/api/jobs/employer/2?page=1",
    "links": {
    {
    "url": null,
    "label": "&laquo; Previous",
    "active": false
    },
    {
    "url": "http://localhost:8000/api/jobs/employer/2?page=1",
    "label": "1",
    "active": true
    },
    {
    "url": null,
    "label": "Next &raquo;",
    "active": false
    }
    },
    "next_page_url": null,
    "path": "http://localhost:8000/api/jobs/employer/2",
    "per_page": 2,
    "prev_page_url": null,
    "to": 2,
    "total": 2
    }
    },
    "status_code": 200
     *              }
     *          ),
     *      ),
     *      @OA\Response(
     *          response=404,
     *          description="No jobs found",
     *          ref="#/components/responses/NotFound"
     *      ),
     *  )
     */
    public function getJobsByEmployerId(Request $request, string $employer_id): JsonResponse
    {
        try {
            $count_per_page = $request->count_per_page;

            $jobs = Job::where('employer_id', $employer_id)->with('job_locations', 'job_skills', 'job_types')->paginate($count_per_page);

            if (count($jobs) === 0) {
                return $this->respondNotFound();
            }

            return $this->respondWithData(
                [
                    'jobs' => $jobs,
                ]);
        }
        catch (Exception $exception) {
            return $this->respondInternalServerError($exception->getMessage());
        }
    }

    /**
     *  @OA\Get(
     *      path="/api/jobs/{id}",
     *      tags={"Jobs"},
     *      summary="Get job by id",
     *      @OA\Parameter(
     *          name="employer_id",
     *          description="Employer id",
     *          required=true,
     *          in="path",
     *      ),
     *      @OA\Parameter(
     *          name="Accept",
     *          in="header",
     *          description="application/json",
     *          required=false
     *      ),
     *      @OA\Response(
     *          response=200,
     *          description="Job retrieved successfully",
     *          @OA\JsonContent(
     *              example=
    {
    "error": false,
    "message": "Xử lí thành công",
    "data": {
    "job": {
    "current_page": 1,
    "data": {
    {
    "id": 1,
    "employer_id": 4,
    "title": "Trợ Lý Trưởng Phòng Xuất Nhập Khẩu",
    "description": "- Tư vấn tính năng, tiện ích và bán các sản phẩm điện thoại, máy tính bảng, Macbook tại Showroom. Không phải đi thị trường.- Phối hợp cùng team Marketing lên kế hoạch triển khai các Event hàng Tuần, Tháng và chương trình Chăm sóc sau Bán Hàng.- Các công việc khác được giao từ Quản lý. ",
    "benefit": "- Lương thỏa thuận (Tùy theo năng lực và kinh nghiệm). Ngoài ra còn chính sách thưởng hiệu quả làm việc.- Thưởng đột xuất theo thành tích đặc biệt và hoặc các sáng kiến cải tiến trong công việc.- Được hưởng đầy đủ quyền lợi của người lao động theo luật hiện hành (Bảo hiểm xã hội, Bảo hiểm y tế).- Được hưởng chế độ du lịch cùng Team, thưởng lễ Tết, thưởng theo doanh số kinh doanh của Công Ty.- Được tham gia đào tạo nâng cao chuyên sâu, chuyên môn và kỹ năng.- Cơ hội phát triển bản thân và thăng tiến trong tổ chức.- Môi trường làm việc năng động, thân thiện. Có cơ hội làm việc với nhiều đối tác lớn, uy tín.- Được hưởng năng suất hàng quý và tăng lương định kỳ. ",
    "requirement": "- Trợ lý Trưởng phòng Xuất nhập khẩu tối thiểu phải tốt nghiệp cử nhân ngành Kinh tế, Ngoại thương hoặc Kinh doanh quốc tế ngành Xuất nhập khẩu hoặc có kinh nghiệm từ 2 năm trở lên trong lĩnh vực này ở vị trí tương đương. Hoặc là dược sĩ và có kinh nghiệm làm việc ở vị trí tương đương.- Ưu tiên các ứng viên đã làm việc hoặc tiếp xúc với môi trường làm việc trong lĩnh vực dược phẩm (background kinh tế) hoặc công ty xuất nhật khẩu (background dược).- Trường hợp không đáp ứng toàn bộ MTCV và yêu cầu công việc nêu trên vẫn sẽ được đào tạo nhưng cần có ý chí mạnh mẽ, quyết tâm học việc, sự tập trung và khả năng chịu áp lực cao.- Có khả năng đàm phán và giao tiếp tốt, chịu áp lực công việc cao.- Có năng lực sắp xếp công việc, lên kế hoạch, báo cáo.- Có tiềm năng và hướng đến vị trí quản lý, điều hành, đưa ra được các đề xuất giúp phát triển phòng Xuất nhập khẩu tiến xa hơn và gắn với chiến lược công ty.- Có khả năng gắn kết, quan tâm, đánh giá và phát triển nguồn nhân lực trong phòng ban phục vụ cho sự phát triển của bản thân mỗi người, công việc và công ty theo giá trị cốt lõi của công ty.- Có kỹ năng sử dụng tiếng Anh, đặc biệt là kỹ năng viết tốt.- Có kỹ năng phân tích, tổng hợp tốt, đánh giá và đề xuất, tham mưu cho Hội đồng thành viên.- Có kỹ năng thuyết trình trước đám đông một cách rõ ràng, dễ hiểu, đạt được hiệu quả cao nhất.- Quyết đoán trong công việc, dám nghĩ dám làm, dám chịu trách nhiệm.- Có phẩm chất đạo đức tốt và trung thực. ",
    "min_salary": -1,
    "max_salary": -1,
    "recruit_num": 1,
    "position": "Toàn thời gian",
    "year_of_experience": "2",
    "deadline": "1970-01-01",
    "job_locations": {
    {
    "id": 1,
    "job_id": 1,
    "location": "Hồ Chí Minh: 72 Bình Giã"
    }
    },
    "job_skills": {
    {
    "id": 1,
    "job_id": 1,
    "skill": "PowerPoint"
    },
    {
    "id": 2,
    "job_id": 1,
    "skill": "Microsoft Excel"
    },
    {
    "id": 3,
    "job_id": 1,
    "skill": "Microsoft Word"
    }
    },
    "job_types": {
    {
    "id": 1,
    "job_id": 1,
    "type": "Nhân viên"
    }
    }
    }
    },
    "first_page_url": "http://localhost:8000/api/jobs/1?page=1",
    "from": 1,
    "last_page": 1,
    "last_page_url": "http://localhost:8000/api/jobs/1?page=1",
    "links": {
    {
    "url": null,
    "label": "&laquo; Previous",
    "active": false
    },
    {
    "url": "http://localhost:8000/api/jobs/1?page=1",
    "label": "1",
    "active": true
    },
    {
    "url": null,
    "label": "Next &raquo;",
    "active": false
    }
    },
    "next_page_url": null,
    "path": "http://localhost:8000/api/jobs/1",
    "per_page": 1,
    "prev_page_url": null,
    "to": 1,
    "total": 1
    }
    },
    "status_code": 200
    }
     *          ),
     *      ),
     *      @OA\Response(
     *          response=404,
     *          description="No job found",
     *          ref="#/components/responses/NotFound"
     *      ),
     *  )
     */
    public function getJobById(string $id): JsonResponse
    {
        try {
            $job = Job::where('id', $id)->with('job_locations', 'job_skills', 'job_types')->paginate(1);

            if (count($job) === 0) {
                return $this->respondNotFound();
            }

            return $this->respondWithData(
                [
                    'job' => $job,
                ]);
        }
        catch (Exception $exception) {
            return $this->respondInternalServerError($exception->getMessage());
        }
    }

    /**
     * @OA\Post(
     *      path="/jobs",
     *      tags={"Jobs"},
     *      summary="Create a new job",
     *      description="Returns the job data",
     *      @OA\Parameter(
     *          name="Accept",
     *          in="header",
     *          description="application/json",
     *          required=false
     *      ),
     *      @OA\Parameter(
     *          name="Authorization",
     *          in="header",
     *          description="Bearer {token}",
     *          required=true
     *      ),
     *      @OA\RequestBody(
     *          required=true,
     *          @OA\JsonContent(
     *              example=
    {
    "title": "job title",
    "description": "job des",
    "benefit": "job ben",
    "requirement": "job req",
    "min_salary": "1",
    "max_salary": "2",
    "recruit_num": "3",
    "position": "pos",
    "year_of_experience": "2",
    "deadline": "2023-09-09",
    }
     *          )
     *      ),
     *      @OA\Response(
     *          response=201,
     *          description="Successfully created job",
     *          @OA\JsonContent(
     *              example=
    {
    "error": false,
    "message": "Xử lí thành công",
    "data": {
    "job": {
    "employer_id": 1,
    "title": "job title",
    "description": "job des",
    "benefit": "job ben",
    "requirement": "job req",
    "min_salary": "1",
    "max_salary": "2",
    "recruit_num": "3",
    "position": "pos",
    "year_of_experience": "2",
    "deadline": "2023-09-09",
    "id": 51
    }
    },
    "status_code": 200
    }
     *          )
     *      ),
     *      @OA\Response(
     *          response=404,
     *          description="No job found",
     *          ref="#/components/responses/NotFound"
     *      ),
     *  )
     */
    public function createJob(Request $request): JsonResponse
    {
        try {
            $job = new Job();

            if ($request->user()->tokenCan('employer')) {
                $job->employer_id = $request->user()->id;
            }
            else {
                $temp_employer_id = EmployerProfile::where('company_id', $request->user()->id)->first()->id;
                $job->employer_id = $temp_employer_id;
            }

            $job->title = $request->title;
            $job->description = $request->description;
            $job->benefit = $request->benefit;
            $job->requirement = $request->requirement;
            $job->min_salary = $request->min_salary;
            $job->max_salary = $request->max_salary;
            $job->recruit_num = $request->recruit_num;
            $job->position = $request->position;
            $job->year_of_experience = $request->year_of_experience;
            $job->deadline = $request->deadline;

            $job->save();

            return $this->respondWithData(
                [
                    'job' => $job,
                ]);
        }
        catch (Exception $exception) {
            return $this->respondInternalServerError($exception->getMessage());
        }
    }

    /**
     * @OA\Put(
     *      path="/jobs/{id}",
     *      tags={"Jobs"},
     *      summary="Update a job",
     *      description="Returns the job data",
     *      @OA\Parameter(
     *          name="id",
     *          description="Job id",
     *          required=true,
     *          in="path",
     *          example="1"
     *      ),
     *      @OA\Parameter(
     *          name="Accept",
     *          in="header",
     *          description="application/json",
     *          required=false
     *      ),
     *      @OA\Parameter(
     *          name="Authorization",
     *          in="header",
     *          description="Bearer {token}",
     *          required=true
     *      ),
     *      @OA\RequestBody(
     *          required=true,
     *          @OA\JsonContent(
     *              example=
    {
    "title": "job title",
    "description": "job des",
    "benefit": "job ben",
    "requirement": "job req",
    "min_salary": "1",
    "max_salary": "2",
    "recruit_num": "3",
    "position": "pos",
    "year_of_experience": "2",
    "deadline": "2023-09-09",
    }
     *          )
     *      ),
     *      @OA\Response(
     *          response=200,
     *          description="Successfully updated job",
     *          @OA\JsonContent(
     *              example=
    {
    "error": false,
    "message": "Xử lí thành công",
    "data": {
    "job": {
    "id": 51,
    "employer_id": 1,
    "title": "titletasdasd",
    "description": "job des",
    "benefit": "job ben",
    "requirement": "job req",
    "min_salary": 1,
    "max_salary": 2,
    "recruit_num": 3,
    "position": "pos",
    "year_of_experience": "2",
    "deadline": "2023-09-09",
    }
    },
    "status_code": 200
    }
     *          )
     *      ),
     *      @OA\Response(
     *          response=404,
     *          description="No job found",
     *          ref="#/components/responses/NotFound"
     *      ),
     *  )
     */
    public function updateJob(Request $request, string $id): JsonResponse
    {
        try {
            $job = Job::where('id', $id)->first();

            if ($job === null) {
                return $this->respondNotFound();
            }

            $job->title = $request->title != null ? $request->title : $job->title;
            $job->description = $request->description != null ? $request->description : $job->description;
            $job->benefit = $request->benefit != null ? $request->benefit : $job->benefit;
            $job->requirement = $request->requirement != null ? $request->requirement : $job->requirement;
            $job->min_salary = $request->min_salary != null ? $request->min_salary : $job->min_salary;
            $job->max_salary = $request->max_salary != null ? $request->max_salary : $job->max_salary;
            $job->recruit_num = $request->recruit_num != null ? $request->recruit_num : $job->recruit_num;
            $job->position = $request->position != null ? $request->position : $job->position;
            $job->year_of_experience = $request->year_of_experience != null ? $request->year_of_experience : $job->year_of_experience;
            $job->deadline = $request->deadline != null ? $request->deadline : $job->deadline;

            $job->save();

            return $this->respondWithData(
                [
                    'job' => $job,
                ]);
        }
        catch (Exception $exception) {
            return $this->respondInternalServerError($exception->getMessage());
        }
    }

    /**
     * @OA\Delete(
     *      path="/jobs/{id}",
     *      tags={"Jobs"},
     *      summary="Delete a job",
     *      description="Returns the job data",
     *      @OA\Parameter(
     *          name="id",
     *          description="Job id",
     *          required=true,
     *          in="path",
     *          example="1"
     *      ),
     *      @OA\Parameter(
     *          name="Accept",
     *          in="header",
     *          description="application/json",
     *          required=false
     *      ),
     *      @OA\Parameter(
     *          name="Authorization",
     *          in="header",
     *          description="Bearer {token}",
     *          required=true
     *      ),
     *      @OA\Response(
     *          response=200,
     *          description="Successfully deleted job",
     *          @OA\JsonContent(
     *              example=
    {
    "error": false,
    "message": "Xoá thành công",
    "data": {
    "job": {
    "id": 52,
    "employer_id": 1,
    "title": "titlet",
    "description": "des",
    "benefit": "be",
    "requirement": "re",
    "min_salary": 1,
    "max_salary": 2,
    "recruit_num": 1,
    "position": "adsfa",
    "year_of_experience": "sfdasdf",
    "deadline": "2023-03-03",
    }
    },
    "status_code": 200
    }
     *          )
     *      ),
     *      @OA\Response(
     *          response=404,
     *          description="No job found",
     *          ref="#/components/responses/NotFound"
     *      ),
     *  )
     */
    public function deleteJob(string $id): JsonResponse
    {
        try {
            $job = Job::where('id', $id)->first();

            if ($job === null) {
                return $this->respondNotFound();
            }

            $job->delete();

            return $this->respondWithData(
                [
                    'job' => $job,
                ], 'Xoá thành công');
        }
        catch (Exception $exception) {
            return $this->respondInternalServerError($exception->getMessage());
        }
    }
}
