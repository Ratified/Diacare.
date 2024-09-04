<?php

namespace App\Http\Controllers;

use App\Models\HealthGoal;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class HealthGoalsController extends Controller
{
    public function index(){
        // Fetch health goals from the database
        $healthGoals = auth()->user()->healthGoals;

        // Fetch a random piece of advice
        $response = Http::get('https://api.adviceslip.com/advice');
        $adviceData = $response->json();

        $advice = $adviceData['slip']['advice'] ?? 'No advice available'; 

        return view('health-goals.index', [
            'healthGoals' => $healthGoals,
            'advice' => $advice,
        ]);
    }

    public function showCreate(){
        return view('health-goals.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string|max:1000',
            'target_date' => 'required|date|after_or_equal:today',
        ]);

        auth()->user()->healthGoals()->create($request->all());

        return redirect()->route('health-goals.index')->with('message', 'Health goal created successfully. Good Luck');
    }

    public function edit($id)
    {
        $goal = HealthGoal::findOrFail($id);
        return view('health-goals.edit', compact('goal'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string|max:1000',
            'target_date' => 'required|date|after_or_equal:today',
        ]);

        $goal = HealthGoal::findOrFail($id);
        $goal->update($request->all());

        return redirect()->route('health-goals.index')->with('message', 'Health goal updated successfully.');
    }

    public function destroy($id)
    {
        $goal = HealthGoal::findOrFail($id);
        $goal->delete();

        return redirect()->route('health-goals.index')->with('message', 'Health goal deleted successfully.');
    }
}