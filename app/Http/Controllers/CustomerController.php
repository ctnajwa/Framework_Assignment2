<?php

namespace App\Http\Controllers;

// use Illuminate\Http\Request;
use App\Models\Customer; 

class CustomerController extends Controller
{
    // Display all customer records in a table
    public function index()
    {
        $customers = Customer::all();
        return view('customers.index', compact('customers'));
    }

    // Filter customers by Gender 
    public function filterByGender($gender)
    {
        // Fetch customers matching the selected gender
        $customers = Customer::where('gender', $gender)->get();
        
        return view('customers.index', compact('customers', 'gender'));
    }

    // Filter customers born AFTER the year 2000
    public function filterByBirthday()
    {
        // Fetch customers whose birthday year is greater than 2000
        $customers = Customer::whereYear('birthday', '>', 2000)->get();
        
        return view('customers.index', compact('customers'));
    }
}
