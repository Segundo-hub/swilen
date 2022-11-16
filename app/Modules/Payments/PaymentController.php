<?php

namespace App\Modules\Payments;

use App\Shared\Http\Controller\Controller;
use Swilen\Http\Request;
use Swilen\Validation\Validator;

final class PaymentController extends Controller
{
    /**
     * @var \App\Modules\Payments\PaymentService
     */
    private $service;

    /**
     * @param \App\Modules\Payments\PaymentService $service
     */
    public function __construct(PaymentService $service)
    {
        $this->service = $service;
    }

    /**
     * Get all payments.
     *
     * @return \Swilen\Http\Response
     */
    public function index()
    {
        $customers = $this->service->all();

        return response()->send($customers);
    }

    /**
     * Get one payment by id.
     *
     * @param int $id
     *
     * @return \Swilen\Http\Response
     */
    public function find(int $id)
    {
        $customer = $this->service->find($id);

        return response()->send($customer);
    }

    /**
     * Create new payment record.
     *
     * @param \Swilen\Http\Request $request
     *
     * @return \Swilen\Http\Response
     */
    public function store(Request $request)
    {
        $customer = Validator::make($request->all(), [
            'transaction_id' => 'required',
            'customer_id' => 'required',
            'amount' => 'required|number',
            'date' => 'required|date',
        ]);

        if ($customer->fails()) {
            return response()->send($customer->errors());
        }

        $store = $this->service->store($customer);

        return response()->send($store);
    }

    /**
     * Update payment record.
     *
     * @param \Swilen\Http\Request $request
     * @param int                  $id
     *
     * @return \Swilen\Http\Response
     */
    public function update(Request $request, int $id)
    {
        $customer = Validator::make($request->all(), [
            'transaction_id' => 'required',
            'customer_id' => 'required',
            'amount' => 'required|number',
            'date' => 'required|date',
        ]);

        if ($customer->fails()) {
            return response()->send($customer->errors());
        }

        $store = $this->service->update($id, $customer);

        return response()->send($store);
    }

    /**
     * Delete payment record.
     *
     * @param int $id Payment id
     *
     * @return \Swilen\Http\Response
     */
    public function remove(int $id)
    {
        $customer = $this->service->delete($id);

        return response()->send($customer);
    }
}
