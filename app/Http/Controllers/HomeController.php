<?php

namespace App\Http\Controllers;

use App\Contracts\SearchableContract;
use App\Repositories\DatabasePostSearchRepository;
use App\Services\FilterPermissionService;
use Illuminate\Http\Request;

class HomeController extends Controller
{

    /**
     * @param Request $request
     * @param DatabasePostSearchRepository $repository
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index(Request $request, SearchableContract $repository, FilterPermissionService $permissionService)
    {
        $ip = $request->ip();
        $response = false;
        $query = $repository->search($request->get('keyword'));

//        dd($query);
//        if ($request->getRequestUri() !== '/') {
//            $response = $permissionService->checkPermission($request, $ip);
//        }
        if ($response) {
            if ($request->filled('active')) {
                switch ((bool)$request->get('active')) {
                    case true:
                        $query->active();
                        break;
                    case false:
                        $query->inactive();
                        break;
                }
            }
            if ($request->filled('sort')) {
                switch ($request->get('sort')) {
                    case 'alphabetical':
                        $query->alphabetically();
                        break;
                    case 'latest':
                        $query->latest();
                        break;
                }
            }
        }

        return view('home')->with([
            'posts' => $query->fetch(),
        ]);

    }


}
