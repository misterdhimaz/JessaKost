<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Bill;
use App\Models\Ticket;

class OwnerController extends Controller
{
    public function dashboard()
    {
        // Mock data for financial graph
        $income = Bill::where('status', 'paid')->sum('amount') ?? 35500000;

        // Count unpaid rent
        $unpaidRent = Bill::where('type', 'rent')->where('status', 'unpaid')->count();

        $pendingApprovals = Ticket::whereNotNull('cost')->where('approval_status', 'pending')->get();

        return view('owner.dashboard', compact('income', 'unpaidRent', 'pendingApprovals'));
    }

    public function reports()
    {
        return view('owner.reports.index');
    }
}
