<?php
use Illuminate\Http\Request;

Route::get('/getMembers', 'Mcrmc\Scrabble\Controllers\ScrabbleControl@getMembers');
Route::get('/getLeague', 'Mcrmc\Scrabble\Controllers\ScrabbleControl@getLeague');
Route::post('/addMember', 'Mcrmc\Scrabble\Controllers\ScrabbleControl@addMember');
Route::post('/playMatch', 'Mcrmc\Scrabble\Controllers\ScrabbleControl@playMatch');