<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\RiskCategory;
use App\Http\Requests\CreateRiskCategoryRequest;

class RiskCategoryController extends Controller
{
    // Display a listing of riskCategories
    public function index()
    {
        $riskcategories = RiskCategory::all();
        return view('riskcategories.index', compact('riskcategories'));
    }

    // Show the form for creating a new riskCategories
    public function create()
    {
        return view('riskcategories.create');
    }

    // Store a newly created RiskCategory in storage
    public function store(CreateRiskCategoryRequest $request)
    {
       $validatedData = $request->validated();
       try {
           $doctor = RiskCategory::create($validatedData);
           return redirect()->route('riskcategories.index')->with('success', 'Risk category created successfully.');
       } catch (\Exception $e) {
           dd($e);
           return back()->withInput()->withErrors(['error' => 'Failed to create Risk category.']);
       }
    }

    // Show the form for editing the specified RiskCategory
    public function edit(RiskCategory $riskcategory)
    {
        return view('riskcategories.edit', compact('riskcategory'));
    }

    // Update the specified RiskCategory in storage
    public function update(CreateRiskCategoryRequest $request, RiskCategory $riskcategory)
    {
        $validatedData = $request->validated();
        try {
            $riskcategory->update($request->all());
            return redirect()->route('riskcategories.index')->with('success', 'Risk category updated successfully.');
        } catch (\Exception $e) {
            return back()->withInput()->withErrors(['error' => 'Failed to create Risk category.']);
        }
    }

    // Remove the specified RiskCategory from storage
    public function destroy(RiskCategory $riskcategory)
    {
        $riskcategory->delete();

        return redirect()->route('riskcategories.index')
                         ->with('success', 'RiskCategory deleted successfully.');
    }
}
