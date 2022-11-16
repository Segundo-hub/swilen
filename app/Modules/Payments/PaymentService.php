<?php

namespace App\Modules\Payments;

use Swilen\Petiole\Facades\DB;

final class PaymentService
{
    /**
     * Store of payments.
     *
     * @var array<array<string, mixed>>
     */
    private $db = [
        [
            'id' => 1,
            'transaction_id' => 'A1B2C-D3E4F-G5H6I-J7K8L-M9N0P',
            'amount' => '50.00',
            'customer_id' => 10,
            'date' => '2021-10-10 00:00:00',
        ],
        [
            'id' => 2,
            'transaction_id' => 'A1B2C-D3E4F-G5H6I-J7K8L-M9N0P',
            'amount' => '750.00',
            'customer_id' => 12,
            'date' => '2022-05-10 00:00:00',
        ],
        [
            'id' => 3,
            'transaction_id' => '1234567891234567',
            'amount' => '100.00',
            'customer_id' => 25,
            'date' => '2021-10-10 00:00:00',
        ],
    ];

    public function all()
    {
        return $this->db;

        // return DB::select(
        //     "SELECT py.*, concat(ct.first_name, ' ', ct.last_name) `owner` from payments py inner join customer ct on ct.id = py.customer_id"
        // );
    }

    public function find(int $id)
    {
        foreach ($this->db as $key => $value) {
            if ($value['id'] === $id) {
                return $value;
            }
        }

        // return DB::selectOne(
        //     "SELECT py.*, concat(ct.first_name, ' ', ct.last_name) `owner` from payments py inner join customer ct on ct.id = py.customer_id WHERE py.id = ?",
        //     [$id]
        // );
    }

    public function store(object $payment)
    {
        return 'inserted';

        // $paymentId = DB::insert('INSERT INTO payments (`transaction_id`, `customer_id`, `amount`, `date`) VALUES (?,?,?,?)', [
        //     $payment->transaction_id,
        //     $payment->customer_id,
        //     $payment->amount,
        //     $payment->date,
        // ]);

        // return $paymentId;
    }

    public function update($id, object $payment)
    {
        return 'updated';

        // return DB::update('UPDATE payments SET `transaction_id` = ?, `customer_id` = ?, `amount` = ?, `date` = ? WHERE id = ?', [
        //     $payment->transaction_id,
        //     $payment->customer_id,
        //     $payment->amount,
        //     $payment->date,
        //     $id,
        // ]);
    }

    public function delete(int $id)
    {
        foreach ($this->db as $key => $value) {
            if ($value['id'] === $id) {
                unset($value);

                return 'ok';
            }
        }

        // return DB::delete('DELETE FROM payments WHERE id = ?', [$id]);
    }
}
