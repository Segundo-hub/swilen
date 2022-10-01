<?php

namespace App\Modules\Payments;

use Swilen\Petiole\Facades\DB;

final class PaymentService
{
    public function all()
    {
        return DB::select(
            "SELECT py.*, concat(ct.first_name, ' ', ct.last_name) `owner` from payments py inner join customer ct on ct.id = py.customer_id"
        );
    }

    public function find(int $id)
    {
        return DB::selectOne(
            "SELECT py.*, concat(ct.first_name, ' ', ct.last_name) `owner` from payments py inner join customer ct on ct.id = py.customer_id WHERE py.id = ?",
            [$id]
        );
    }

    public function store(object $payment)
    {
        $paymentId = DB::insert('INSERT INTO payments (`transaction_id`, `customer_id`, `amount`, `date`) VALUES (?,?,?,?)', [
            $payment->transaction_id,
            $payment->customer_id,
            $payment->amount,
            $payment->date,
        ]);

        return $paymentId;
    }

    public function update($id, object $payment)
    {
        return DB::update('UPDATE payments SET `transaction_id` = ?, `customer_id` = ?, `amount` = ?, `date` = ? WHERE id = ?', [
            $payment->transaction_id,
            $payment->customer_id,
            $payment->amount,
            $payment->date,
            $id,
        ]);
    }

    public function delete(int $id)
    {
        return DB::delete("DELETE FROM payments WHERE id = ?", [$id]);
    }
}
