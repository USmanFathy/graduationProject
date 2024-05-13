<?php

namespace App\Http\Controllers\Dashboard;

use App\Events\ApproveBorrowRequest;
use App\Events\ApproveBorrowRequestPDfBookEvent;
use App\Events\RejectBorrowRequest;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreBorrowRequest;
use App\Models\Borrow;
use App\Models\Product;
use Illuminate\Http\Request;

class BorrowDashboardController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $borrows= Borrow::with(['product','user'])->paginate(20);
        return view('Dashboard.borrows.index',compact('borrows'));
    }

    public function approve(Borrow $borrow)
    {
        try {
            if ($borrow->status == 'pending'){
                $borrow->update(['status'=>'accepted']);
                if ($borrow->product->type == 'pdf'){(
                    event(new  ApproveBorrowRequestPDfBookEvent($borrow->user() , $borrow->product(),$borrow)));
                }else{
                    event(new ApproveBorrowRequest($borrow->user()));
                }
                return redirect()->route('borrows.index')->with('success','Borrow Request Have Been Approved');

            }
        }catch (\Exception $e) {
            throw new \Exception($e->getMessage());
        }
    }
    public function reject(Borrow $borrow)
    {
        try {
            if ($borrow->status == 'pending'){
                $borrow->update(['status'=>'rejected']);
                event(new RejectBorrowRequest($borrow->user()));
                return redirect()->route('borrows.index')->with('success','Borrow Request Have Been Rejected');

            }
        }catch (\Exception $e) {
            throw new \Exception($e->getMessage());
        }
    }
    public function destroy(Borrow $borrow)
    {
        $borrow->delete();
        return redirect()->route('borrows.index');
    }
}
