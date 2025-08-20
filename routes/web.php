<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;

use App\Models\User;
use App\Models\Column;
use App\Models\Card;
use App\Models\Board;

use Inertia\Inertia;

Route::get('/', function () {
    return Inertia::render('Welcome');
})->name('home');

Route::get('/dashboard', function () {
    $user = auth()->user();
    $boards = $user->boards()->get();

    return Inertia::render('Dashboard', [
        'boards' => $boards,
    ]);
})->middleware(['auth', 'verified'])->name('dashboard');

Route::get('board/{id}', function ($id) {
    // pega a board com ID 1
    $board = Board::find($id);

    if (!$board) {
        abort(404, 'Board não encontrada');
    }

    $columns = $board->columns()->with('cards')->get();

    return Inertia::render('Board', [
        'columns' => $columns,
        'board' => $board,
    ]);
})
    ->middleware(['auth', 'verified'])
    ->name('board.show');

Route::post('/cards', function (Request $request) {
    $validated = $request->validate([
        'title' => 'required|string|max:255',
        'column_id' => 'required|exists:columns,id',
        'description' => 'nullable|string|max:2250',
    ]);

    $card = Card::create([
        'title' => $validated['title'],
        'column_id' => $validated['column_id'],
        'description' => $validated['description'],
        'position' => 0, // ou lógica de posição
    ]);

    return redirect()->back(); // ou Inertia::location() se quiser
})
    ->middleware(['auth', 'verified'])
    ->name('cards.store');

Route::post('/columns', function (Request $request) {
    $validated = $request->validate([
        'title' => 'required|string|max:255',
        'board_id' => 'required|exists:boards,id',
    ]);

    $column = Column::create([
        'title' => $validated['title'],
        'board_id' => $validated['board_id'],
        'position' => 0,
    ]);

    return redirect()->back(); // ou Inertia::location() se quiser
})
    ->middleware(['auth', 'verified'])
    ->name('columns.store');

Route::post('/boards', function (Request $request) {
    $validated = $request->validate([
        'name' => 'required|string|max:255',
    ]);

    $board = $request->user()->boards()->create($validated);

    return redirect()->route('board.show', $board->id); 
})
    ->middleware(['auth', 'verified'])
    ->name('boards.create');

require __DIR__ . '/settings.php';
require __DIR__ . '/auth.php';
