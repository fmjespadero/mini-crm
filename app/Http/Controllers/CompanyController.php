<?php

namespace App\Http\Controllers;

use App\Models\Company;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Yajra\DataTables\Facades\DataTables;

class CompanyController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if (request()->ajax()) {
            $companies = Company::query();

            return DataTables::of($companies)
                ->addColumn('action', function ($company) {
                    return view('companies.action_buttons', compact('company'))->render();
                })
                ->editColumn('website', function ($company) {
                    return $company->website ? "<a href='{$company->website}' target='_blank'>{$company->website}</a>" : '';
                })
                ->rawColumns(['action', 'website'])
                ->make(true);
        }

        return view('companies.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('companies.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Company $company)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Company $company)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Company $company)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $company = Company::findOrFail($id);
        $company->delete();
    
        return response()->json(['success' => 'Company deleted successfully.']);
    }
}