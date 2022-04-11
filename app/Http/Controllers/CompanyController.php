<?php

namespace App\Http\Controllers;

use App\Http\Requests\Company\StoreRequest;
use App\Model\Company;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CompanyController extends Controller
{

    public function index()
    {

    }


    public function create()
    {
        //
    }


    public function store(Request $request)
    {

    }


    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        $company = Company::find(Auth::user()->company_id);
        return view('company.index', compact('company'));
    }


    public function update(StoreRequest $request, $id): RedirectResponse
    {
        $result = Company::find(Auth::user()->company_id)->update($request->input());
        if ($result) {
            return redirect()
                ->route('home')
                ->with(['title' => 'Успешно', 'text' => 'Изменения сохранены']);
        } else {
            return back()
                ->withErrors(['msg' => 'Ошибка добавления'])
                ->withInput();
        }
    }


    public function destroy($id)
    {
        //
    }
}
