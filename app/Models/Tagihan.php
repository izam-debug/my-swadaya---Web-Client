<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Tagihan extends Model
{
    use HasFactory;

    protected $table = 'tagihan';
    protected $fillable = [
        'kode_client',
        'id_petugas',
        'nomor_meter',
        'pemakaian',
        'tagihan',
        'status_tagihan',
    ];

    public function index_tagihan()
    {
        return $this->join('client', 'client.kode_client','=', 'tagihan.kode_client')
                    // ->where('tagihan.status_tagihan', '=', 'Belum Disiarkan')
                    ->select('client.nama_client', 'tagihan.*')
                    ->get();
    }

    public function kwitansi($id)
    {

        $tagihan_sekarang = $this->join('client', 'client.kode_client', '=', 'tagihan.kode_client')
                    ->where('tagihan.id', '=', $id)
                    ->select('client.nama_client', 'tagihan.*')
                    ->first();

        $kode_client = Tagihan::where('id', $id)->pluck('kode_client')->first();

        $tagihan_sebelumnya = $this->join('client', 'client.kode_client', '=', 'tagihan.kode_client')
                               ->where('tagihan.kode_client', $kode_client)
                               ->where('tagihan.id', '<', $id)
                               ->select('client.nama_client', 'tagihan.*')
                               ->orderBy('tagihan.id', 'desc')
                               ->first();
                               
        return (compact('tagihan_sekarang', 'tagihan_sebelumnya'));
    }

    public function scopeCurrentMonth($query)
    {
        return $query->whereMonth('created_at', Carbon::now()->month)
                    ->whereYear('created_at', Carbon::now()->year);
    }

    public function api_get()
    {
        return $this->join('client', 'client.kode_client', '=', 'tagihan.kode_client')
                    ->whereMonth('tagihan.created_at', Carbon::now()->month)
                    ->whereYear('tagihan.created_at', Carbon::now()->year)
                    ->select('client.nama_client AS namaClient', 'client.kode_client AS kodeClient', 'tagihan.nomor_meter AS nomorMeter', 'tagihan.id')
                    ->get();
    }
}
