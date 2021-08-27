<?php

namespace Authentication\Http\Controllers;

use Illuminate\Routing\Controller;
use Authentication\Http\Requests\UpdatePasswordRequest;
use Authentication\Repositories\UserRepository;

class ProfileController extends Controller
{
    private $repository;

    public function __construct(UserRepository $repository)
    {
        $this->repository = $repository;
    }

    public function index()
    {
        $dados = $this->repository->with('roles')->find(auth()->id());
        return view('authentication::users.profile.index', compact('dados'));
    }

    public function edit()
    {
        return view('authentication::users.profile.edit');
    }

    public function update(UpdatePasswordRequest $request)
    {
        try {
            \DB::transaction(function () use ($request) {
                $this->repository->updatePassword($request->only(['password']), auth()->id());
            });
            return redirect()->route('profile')->with('message', 'Senha alterada com sucesso.');
        } catch (\Exception $e) {
            return redirect()->back()->with('message-danger', 'Erro ao tentar alterar senha.')->withInput();
        }
    }
}
