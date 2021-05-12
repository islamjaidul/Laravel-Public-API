<?php

namespace App\v1\Report\Action;

use Illuminate\Http\Request;
use Shared\Http\Action\BaseAction;
use App\v1\Report\Responder\ReportResponder;
use App\v1\Report\Domain\Service\ReportService;

class ReportAction extends BaseAction
{
    private $service;
    private $request;
    private $responder;

    public function __construct
    (
        Request $request,
        ReportService $reportService,
        ReportResponder $reportResponder
    )
    {
        $this->request      = $request;
        $this->service      = $reportService;
        $this->responder    = $reportResponder;
    }


    /**
     * @OA\Get(
     *      path="/api/v1/reports",
     *      summary="Get list of reports",
     *      description="Returns list of reports",
     *      @OA\Response(
     *          response=200,
     *          description="Successful operation",
     *          @OA\JsonContent(),
     *       ),
     *      @OA\Response(
     *          response=401,
     *          description="Unauthenticated",
     *      ),
     *      @OA\Response(
     *          response=403,
     *          description="Forbidden"
     *      )
     *     )
     */
    public function index()
    {
        try {
            return $this->responder
            ->respondAll(
                $this->service->handleAll()
            );
        } catch (\Exception $e) {
            return response()->json([
                'status' => false,
                'message' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * @OA\Get(
     *      path="/api/v1/reports/{id}",
     *      summary="Get single report",
     *      description="Returns single report",
     *      @OA\Parameter(
     *          name="id",
     *          description="Report id",
     *          required=true,
     *          in="path",
     *          @OA\Schema(
     *              type="integer"
     *          )
     *      ),
     *      @OA\Response(
     *          response=200,
     *          description="Successful operation",
     *          @OA\JsonContent(),
     *       ),
     *      @OA\Response(
     *          response=401,
     *          description="Unauthenticated",
     *      ),
     *      @OA\Response(
     *          response=403,
     *          description="Forbidden"
     *      )
     *     )
     */
    public function show($id)
    {
        try {
            return $this->responder
            ->respondFind(
                $this->service->handleFind($id)
            );
        } catch (\Exception $e) {
            return response()->json([
                'status' => false,
                'message' => $e->getMessage()
            ], 500); 
        }
    }

    /**
     * @OA\Post(
     *      path="/api/v1/reports",
     *      summary="Create an report",
     *      description="Returns boolean",
     *      @OA\Response(
     *          response=201,
     *          description="Successful operation",
     *          @OA\JsonContent(),
     *       ),
     *      @OA\Response(
     *          response=401,
     *          description="Unauthenticated",
     *      ),
     *      @OA\Response(
     *          response=403,
     *          description="Forbidden"
     *      )
     *     )
     */
    public function store(Request $request)
    {
        try {
            return $this->responder
            ->respondStore(
                $this->service->handleCreate($request->all())
            );
        } catch (\Exception $e) {
            return response()->json([
                'status' => false,
                'message' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * @OA\Put(
     *      path="/api/v1/reports/{id}",
     *      summary="Update an report",
     *      description="Returns boolean",
     *      @OA\Parameter(
     *          name="id",
     *          description="Report id",
     *          required=true,
     *          in="path",
     *          @OA\Schema(
     *              type="integer"
     *          )
     *      ),
     *      @OA\Response(
     *          response=200,
     *          description="Successful operation",
     *          @OA\JsonContent(),
     *       ),
     *      @OA\Response(
     *          response=401,
     *          description="Unauthenticated",
     *      ),
     *      @OA\Response(
     *          response=403,
     *          description="Forbidden"
     *      )
     *     )
     */
    public function update(Request $request, $id)
    {
        try {
            return $this->responder
            ->respondUpdate(
                $this->service->handleUpdate($request->all(), $id)
            );
        } catch (\Exception $e) {
            return response()->json([
                'status' => false,
                'message' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * @OA\Delete(
     *      path="/api/v1/reports/{id}",
     *      summary="Delete an report",
     *      description="Returns boolean",
     *      @OA\Parameter(
     *          name="id",
     *          description="Report id",
     *          required=true,
     *          in="path",
     *          @OA\Schema(
     *              type="integer"
     *          )
     *      ),
     *      @OA\Response(
     *          response=200,
     *          description="Successful operation",
     *          @OA\JsonContent(),
     *       ),
     *      @OA\Response(
     *          response=401,
     *          description="Unauthenticated",
     *      ),
     *      @OA\Response(
     *          response=403,
     *          description="Forbidden"
     *      )
     *     )
     */
    public function destroy($id)
    {
        try {
            return $this->responder
            ->respondDelete(
                $this->service->handleDelete($id)
            );
        } catch (\Exception $e) {
            return response()->json([
                'status' => false,
                'message' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * @OA\Get(
     *      path="/api/v1/reports/search",
     *      summary="Get list of reports by using search query string",
     *      description="Returns filtered reports",
     *      @OA\Response(
     *          response=200,
     *          description="Successful operation",
     *          @OA\JsonContent(),
     *       ),
     *      @OA\Response(
     *          response=401,
     *          description="Unauthenticated",
     *      ),
     *      @OA\Response(
     *          response=403,
     *          description="Forbidden"
     *      )
     *     )
     */
    public function search(Request $request)
    {
        try {
            return $this->service->handleAll($request->query());
        } catch (\Exception $e) {
            return response()->json([
                'status' => false,
                'message' => $e->getMessage()
            ], 500); 
        }   
    }
}