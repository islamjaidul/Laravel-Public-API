<?php

namespace App\v1\Ticket\Action;

use Illuminate\Http\Request;
use Shared\Http\Action\BaseAction;
use App\v1\Ticket\Responder\TicketResponder;
use App\v1\Ticket\Domain\Service\TicketService;

class TicketAction extends BaseAction
{
    private $service;
    private $request;
    private $responder;

    public function __construct
    (
        Request $request,
        TicketService $ticketService,
        TicketResponder $ticketResponder
    )
    {
        $this->request      = $request;
        $this->service      = $ticketService;
        $this->responder    = $ticketResponder;
    }


    /**
     * @OA\Get(
     *      path="/api/v1/tickets",
     *      summary="Get list of tickets",
     *      description="Returns list of tickets",
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
     *      path="/api/v1/tickets/{id}",
     *      summary="Get single ticket",
     *      description="Returns single ticket",
     *      @OA\Parameter(
     *          name="id",
     *          description="Ticket id",
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
     *      path="/api/v1/tickets",
     *      summary="Create an ticket",
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
     *      path="/api/v1/tickets/{id}",
     *      summary="Update an ticket",
     *      description="Returns boolean",
     *      @OA\Parameter(
     *          name="id",
     *          description="Ticket id",
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
     *      path="/api/v1/tickets/{id}",
     *      summary="Delete an ticket",
     *      description="Returns boolean",
     *      @OA\Parameter(
     *          name="id",
     *          description="Ticket id",
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
     *      path="/api/v1/tickets/search",
     *      summary="Get list of tickets by using search query string",
     *      description="Returns filtered tickets",
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