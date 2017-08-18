<?php

namespace TravelPlanner\Http\Controllers;

use EllipseSynergie\ApiResponse\Contracts\Response;
use Illuminate\Http\Request;
use TravelPlanner\Http\Requests\Route\UpdateRequest;
use TravelPlanner\Models\Role;
use TravelPlanner\Models\Route;
use TravelPlanner\Repositories\RouteRepository;
use TravelPlanner\Transformers\RouteTransformer;

class RouteController extends Controller
{
    /**
     * @param RouteRepository
     */
    public function __construct(RouteRepository $routeRepository, Response $response)
    {
        $this->routes = $routeRepository;
        $this->response = $response;
    }

    /**
     * Get all Routes
     *
     * Gets all the routes.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $roles = Role::orderBy('level')->get()->map->transformToResponse();
        return $this->response->withCollection($this->routes->getAllSortedByName(), new RouteTransformer, null, null, compact('roles'));
    }

    /**
     * Toggle role permission
     *
     * Toggles the permission over the given role_id.
     *
     * @param  \Pasify\Http\Requests\Route\UpdateRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateRequest $request, $id)
    {
        $route = $this->routes->findOrFail($id);
        return $this->response->withArray($this->routes->toggleRole($route, $request->role_id));
    }

}
