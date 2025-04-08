<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Stage;
use Illuminate\Http\Request;

use App\Models\Fine;
use App\Models\Student;


class FineController extends Controller
{
   
        public function index()
        {
            $fines = Fine::paginate(10);  // or paginate if you want
            return view('admins.fines.index', compact('fines'));
           
        }
    
        // Show the form for creating a new fine
        public function create()
        {
            $students = Student::all(); // Get all students for the dropdown
            return view('admins.fines.create', compact('students'));
        }
    
        // Store a newly created fine in the database
        public function store(Request $request)
        {
            // Validate the request data
            $request->validate([
                'student_id' => 'required|exists:students,id',
                'amount' => 'required|numeric|min:0',
                'reason' => 'required|string|max:255',
                'status' => 'required|in:pending,paid',
            ]);
    
            // Create a new fine
            Fine::create($request->all());
    
            // Redirect back with a success message
            return redirect()->route('fines.index')->with('success', 'Fine created successfully.');
        }
    
        // Display the specified fine
        public function show(Fine $fine)
        {
            return view('admins.fines.show', compact('fine'));
        }
    
        // Show the form for editing the specified fine
        public function edit($id)
        {
            $fine = Fine::findOrFail($id);
            $students = Student::all();
            return view('admins.fines.edit', compact('fine', 'students'));
        }
        // Update the specified fine in the database
        public function update(Request $request, Fine $fine)
        {
            // Validate the request data
            $request->validate([
                'student_id' => 'required|exists:students,id',
                'amount' => 'required|numeric|min:0',
                'reason' => 'required|string|max:255',
                'status' => 'required|in:pending,paid',
            ]);
    
            // Update the fine
            $fine->update($request->all());
          

            // Redirect back with a success message
            return redirect()->route('fines.index')->with('success', 'Fine updated successfully.');
        }
    
        // Remove the specified fine from the database
    


        public function destroy(Fine $fine)
        {
            try {
                $fine->delete();
                return response()->json(['success' => true, 'message' => 'تم حذف الغرامة بنجاح!']);
            } catch (\Exception $e) {
                return response()->json(['success' => false, 'message' => 'فشل في حذف الغرامة!'], 500);
            }
        }
    }
    