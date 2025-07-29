<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Models\ReturnOrder;


class ReturnOrderController extends Controller
{

    public function index()
    {
        $returns = ReturnOrder::all();
        return view('admin.returns.index', compact('returns'));
    }

    public function show($id)
    {
        $return = ReturnOrder::findOrFail($id);
        return view('admin.returns.show', compact('return'));
    }


    public function update(Request $request, $id)
    {
        $return = ReturnOrder::findOrFail($id);
        $return->update($request->all());
        return redirect()->route('admin.returns.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
    public function downloadPdf()
    {
        $returns = ReturnOrder::all();
        $pdf = PDF::loadView('admin.returns.report', compact('returns'));
        return $pdf->download('return_report.pdf');
    }
}
