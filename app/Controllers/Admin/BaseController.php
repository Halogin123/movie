<?php

namespace MovieChill\app\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class BaseController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request, array $params = [])
    {
        $search = $request->input('search');

        if (!empty($search)) {
            $params[] = [
                'field' => 'code',
                'operator' => 'like',
                'value' => '%' . $search . '%',
            ];
        }

        $data = $this->getService()->getList($params);
        $route = [
            'destroy' => $this->getRouteDestroy(),
            'create' => $this->getRouteCreate(),
            'update' => $this->getRouteUpdate(),
            'edit' => $this->getRouteEdit(),
            'index' => $this->getRouteIndex(),
            'store' => $this->getRouteStore(),
            'show' => $this->getRouteShow(),
            'key' => $this->getRouteKey()
        ];
        $resource = $this->getResourceName();
        return view($this->getResourceIndexPath(), compact('data', 'route', 'resource', 'search'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $route = [
            'destroy' => $this->getRouteDestroy(),
            'create' => $this->getRouteCreate(),
            'update' => $this->getRouteUpdate(),
            'edit' => $this->getRouteEdit(),
            'index' => $this->getRouteIndex(),
            'store' => $this->getRouteStore(),
            'show' => $this->getRouteShow(),
            'key' => $this->getRouteKey()
        ];
        $resource = $this->getResourceName();

        return view($this->getResourceCreatePath(), compact('route', 'resource'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $requestData = $this->getRequest($request);
        $data = $this->getService()->create($requestData);

        return redirect()->route($this->getRouteShow(), [$this->getRouteKey() => $data->id]);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $data = $this->getService()->getDetail($id);
        $route = [
            'destroy' => $this->getRouteDestroy(),
            'create' => $this->getRouteCreate(),
            'update' => $this->getRouteUpdate(),
            'edit' => $this->getRouteEdit(),
            'index' => $this->getRouteIndex(),
            'store' => $this->getRouteStore(),
            'show' => $this->getRouteShow(),
            'key' => $this->getRouteKey()
        ];
        $resource = $this->getResourceName();

        return view($this->getResourceShowPath(), compact('data', 'route', 'resource'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $data = $this->getService()->getDetail($id);
        $route = [
            'destroy' => $this->getRouteDestroy(),
            'create' => $this->getRouteCreate(),
            'update' => $this->getRouteUpdate(),
            'edit' => $this->getRouteEdit(),
            'index' => $this->getRouteIndex(),
            'store' => $this->getRouteStore(),
            'show' => $this->getRouteShow(),
            'key' => $this->getRouteKey()
        ];
        $resource = $this->getResourceName();

        return view($this->getResourceEditPath(), compact('data', 'route', 'resource'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $requestData = $this->getRequest($request);
        $this->getService()->update($requestData, $id);

        return redirect()->route($this->getRouteShow(), [$this->getRouteKey() => $id]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $this->getService()->delete($id);

        return redirect()->route($this->getRouteIndex());
    }

    public function getService()
    {
        if (property_exists($this, 'service') && !empty($this->service)) {
            return $this->service;
        } else {
            throw new \InvalidArgumentException('The property "service" is not defined');
        }
    }

    public function getResourceName()
    {
        if (property_exists($this, 'resourceName') && !empty($this->resourceName)) {
            return $this->resourceName;
        } else {
            throw new \InvalidArgumentException('The property "resourceName" is not defined');
        }
    }

    public function getRouteKey()
    {
        if (property_exists($this, 'routeKey') && !empty($this->routeKey)) {
            return $this->routeKey;
        } else {
            throw new \InvalidArgumentException('The property "routeKey" is not defined');
        }
    }

    private function getRouteIndex(): string
    {
        return $this->getResourceName() . ".index";
    }

    private function getRouteShow(): string
    {
        return $this->getResourceName() . ".show";
    }

    private function getRouteUpdate(): string
    {
        return $this->getResourceName() . ".update";
    }

    private function getRouteDestroy(): string
    {
        return $this->getResourceName() . ".destroy";
    }

    private function getRouteStore(): string
    {
        return $this->getResourceName() . ".store";
    }

    private function getRouteEdit(): string
    {
        return $this->getResourceName() . ".edit";
    }

    private function getRouteCreate(): string
    {
        return $this->getResourceName() . ".create";
    }

    private function getResourceIndexPath(): string
    {
        return ADMIN_PREFIX . ".base.index";
    }

    private function getResourceCreatePath(): string
    {
        return ADMIN_PREFIX . ".base.create";
    }

    private function getResourceEditPath(): string
    {
        return ADMIN_PREFIX . ".base.edit";
    }

    private function getResourceShowPath(): string
    {
        return ADMIN_PREFIX . ".base.show";
    }

    private function getRequest($request)
    {
        $requestData = $request->all();
        unset($requestData['_token']);

        return $requestData;
    }
}
