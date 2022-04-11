<?php

use App\Http\Controllers\PDFController;
use App\Http\Controllers\Tournament\TournamentLogs;
use App\Http\Resources\CashResource;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\RequestException;
use GuzzleHttp\Handler\MockHandler;
use GuzzleHttp\HandlerStack;
use Illuminate\Support\Facades\Route;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
Auth::routes();

Route::get('/', function () {
    return view('home');
})->name('home')->middleware('auth');


Route::get('tournament-table/{id}', 'Tournament\TournamentBoard@index')->name('t-board')->middleware('auth');

/*=========TOURNAMENT=========*/
Route::group(['prefix' => ''], function () {
    $methods = ['index', 'edit', 'update', 'create', 'store'];
    Route::resource('tournament', 'Tournament\TournamentController')
        ->only($methods)
        ->names('tournament')
        ->middleware('auth');
    Route::post('tournament/destroy', 'Tournament\TournamentController@destroy')->name('tournament.destroy');
});
Route::get('tournament/{id}/information', 'Tournament\TournamentController@information')->name('tournament.information');
/*=========END TOURNAMENT=========*/


Route::group(['prefix' => ''], function () {
    $methods = ['index', 'edit', 'update', 'create', 'store'];
    Route::resource('cash', 'Cash\CashGameController')
        ->only($methods)
        ->names('cash')
        ->middleware('auth');
});
Route::post('cash/destroy', 'Cash\CashGameController@destroy')->name('cash.destroy');

Route::get('cash/{id}/manage', 'Cash\CashManage@index')->name('cash.manage');


Route::middleware(['auth'])->group(function () {
    Route::get('tournament/{id}/manage', 'Tournament\TournamentManage@index')->name('tournament.manage');
    Route::post('tournament/playPauseTournament', 'Tournament\TournamentManage@playPauseTournament')->name('tournament.playPauseTournament');
    Route::post('tournament/refreshTournamentBoard', 'Tournament\TournamentBoard@refresh')->name('tournament.refreshTournamentBoard');
    Route::post('tournament/calculatePrizePool', 'Tournament\TournamentManage@calculatePrizePool')->name('tournament.calculatePrizePool');
    Route::post('tournament/groupDebtors', 'Tournament\TournamentManage@groupDebtors')->name('tournament.groupDebtors');
    Route::post('tournament/nextLevel', 'Tournament\TournamentManage@nextLevel')->name('tournament.nextLevel');
    Route::post('tournament/prevLevel', 'Tournament\TournamentManage@previousLevel')->name('tournament.prevLevel');
    Route::post('tournament/refreshLevel', 'Tournament\TournamentManage@refreshLevel')->name('tournament.refreshLevel');
    Route::post('tournament/complete', 'Tournament\TournamentManage@complete')->name('tournament.complete');
});


Route::post('tournament/logs', [TournamentLogs::class, 'get'])->name('tournament.logs');


Route::group(['prefix' => ''], function () {
    $methods = ['store'];
    Route::resource('cashRake', 'Cash\CashRakeController')
        ->only($methods)
        ->names('cashRake')
        ->middleware('auth');
});
Route::post('cashRake/destroy', 'Cash\CashRakeController@destroy')->name('cashRake.destroy');


Route::group(['prefix' => ''], function () {
    $methods = ['store'];
    Route::resource('cashBuyIn', 'Cash\CashBuyInController')
        ->only($methods)
        ->names('cashBuyIn')
        ->middleware('auth');
});
Route::post('cashBuyIn/destroy', 'Cash\CashBuyInController@destroy')->name('cashBuyIn.destroy');


Route::group(['prefix' => ''], function () {
    $methods = ['store'];
    Route::resource('tournamentPlayer', 'Tournament\TournamentPlayerController')
        ->only($methods)
        ->names('tournamentPlayer')
        ->middleware('auth');
});

Route::post('tournamentPlayer/destroy', 'Tournament\TournamentPlayerController@destroy')->name('tournamentPlayer.destroy');
Route::post('tournamentPlayer/evaluate', 'Tournament\TournamentPlayerController@knockPlayerToggle')->name('tournamentPlayer.evaluate');
Route::post('tournamentPlayer/unDebtor', 'Tournament\TournamentPlayerController@unDebtorByName')->name('tournamentPlayer.unDebtorByName');
Route::post('tournamentPlayer/getPayCheck', 'Tournament\TournamentPlayerController@getPayCheck')->name('tournamentPlayer.getPayCheck');


Route::post('showSidebar', 'MainController@smallSidebar')->name('smallSidebar');


/*=========COMPANY=========*/
Route::group(['prefix' => ''], function () {
    $methods = ['index', 'edit', 'update', 'create', 'store'];
    Route::resource('company', 'CompanyController')
        ->only($methods)
        ->names('company')
        ->middleware('auth');
});
/*=========END COMPANY=========*/


Route::group(['prefix'=>'dealers'], function(){
    Route::get('/', function () {
        return view('dealer.index');
    })->name('dealer.web.index')->middleware('auth');
    Route::get('/create', function () {
        return view('dealer.index');
    })->name('dealer.web.create')->middleware('auth');
});

Route::get('resume', 'MainController@resume')->name('resume');
Route::get('resume-en', 'MainController@resumeEn')->name('resume-en');

Route::post('/dealer/register', 'DealerController@store')->name('auth.createWithCompany');

Route::get('/{vue_capture?}', function () {
    return view('dealer.index');
})->where('vue_capture', '[\/\w\.-]*');

