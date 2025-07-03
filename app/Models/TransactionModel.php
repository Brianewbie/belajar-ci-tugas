<?php

namespace App\Models;

use CodeIgniter\Model;

class TransactionModel extends Model
{
    protected $table = 'transaction';
    protected $primaryKey = 'id';
    protected $allowedFields = [
        'username', 'total_harga', 'alamat', 'ongkir', 'status', 'created_at', 'updated_at'
    ];

    /**
     * 
     *
     * @return array
     */
    public function getTransactionsWithItemCount()
    {
        return $this->db->table('transaction t')
            ->select('t.*, SUM(td.jumlah) as jumlah_item')
            ->join('transaction_detail td', 'td.transaction_id = t.id', 'left')
            ->groupBy('t.id')
            ->orderBy('t.created_at', 'DESC')
            ->get()
            ->getResultArray();
    }
}
