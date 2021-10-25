<?php

namespace App\Http\Controllers;

use App\Models\Agenda;
use App\Models\Kiriman;
use App\Models\Layanan;
use App\Models\Produk;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        $user = User::all()->count();
        $kiriman = Kiriman::all()->count();
        $layanan = Layanan::all()->count();
        $agenda = Agenda::all()->count();
        $produk = Produk::all()->count();
        return view('menu.user.dashboard', ['user' => $user, 'kiriman' => $kiriman, 'layanan' => $layanan, 'agenda' => $agenda, 'produk' => $produk]);
    }
}
