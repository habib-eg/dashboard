<?php

namespace Habib\Dashboard\Http\Controllers;

use Exception;
use Illuminate\Contracts\View\Factory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\View\View;

/**
 * Class CRUDController
 * @package Habib\Dashboard\Http\Controllers
 */
class CRUDController extends Controller
{

    /**
     * @var Model
     */
    protected $model;

    /**
     * @var array
     */
    protected $view = [];
    /**
     * @var null
     */
    protected $defaultView = null;
    /**
     * @var string
     */
    protected $prefixViewName = '';

    /**
     * @var array
     */
    protected $parameters = [];
    /**
     * @var array
     */
    protected $storeValidation = [];
    /**
     * @var array
     */
    protected $updateValidation = [];
    /**
     * @var bool
     */
    protected $api = false;

    /**
     * @return Factory|View|Model
     */
    public function index()
    {
        $data = $this->getModel()::latest()->paginate();
        if ($this->api) {
            return $data;
        }
        $word = __FUNCTION__;
        return $this->callview($word, $this->view[$word] ?? $this->defaultView($word), [
            $this->parameters[$word] ?? $this->defaultParameter(__FUNCTION__) => $data
        ]);
    }

    /**
     * @return Model
     */
    public function getModel()
    {
        return $this->model;
    }

    /**
     * @param string $model
     * @return $this
     */
    public function setModel(string $model): self
    {
        $this->model = $model;

        return $this;
    }

    /**
     * @param string $functionName
     * @param string $view
     * @param array $data
     * @return View
     */
    public function callView(string $functionName, string $view, array $data = []): View
    {

        return view($this->prefixViewName . $view, $data);
    }

    /**
     * @param string $view
     * @return string
     */
    public function defaultView(string $view): string
    {

        $viewName = ($this->defaultView ?? $this->defaultParameter()) . "." . $view;

        return $this->prefixViewName . $viewName;
    }

    /**
     * @param string|null $function
     * @return string
     */
    public function defaultParameter(string $function = null): string
    {
        $function = $function ?? class_basename($this->getModel());
        return strtolower($function);
    }

    /**
     * @param $id
     * @return Exception|Factory|Model|View|mixed
     */
    public function show($id)
    {
        $model = $this->find($id);
        if ($this->api) {
            return $model;
        }
        $word = __FUNCTION__;
        return $this->callview($word, $this->view[$word] ?? $this->defaultView($word), [
            $this->parameters[$word] ?? $this->defaultParameter(__FUNCTION__) => $model
        ]);
    }

    /**
     * @param $id
     * @return Model|mixed|Exception
     */
    public function find($id)
    {
        $class = $this->getModel();

        $model = (new $class)->resolveRouteBinding($id);

        abort_if(!$model, 404);

        return $model;
    }

    /**
     * @return Request|mixed
     */

    /**
     * @param $id
     * @return Exception|Factory|Model|View|mixed
     */
    public function edit($id)
    {
        $model = $this->find($id);
        if ($this->api) {
            return $model;
        }
        $word = __FUNCTION__;
        return $this->callview($word, $this->view[$word] ?? $this->defaultView($word), [
            $this->parameters[$word] ?? $this->defaultParameter(__FUNCTION__) => $model
        ]);
    }

    /**
     * @return Factory|View
     */
    public function create()
    {
        $word = __FUNCTION__;
        return $this->callview($word, $this->view[$word] ?? $this->defaultView($word));
    }

    /**
     * @return RedirectResponse
     */
    public function store()
    {

        $validated = $this->validation(request()->validate($this->storeValidation ?? []));

        $created = $this->getModel()::create($validated);
        if (method_exists($this, 'created')) {
            call_user_func([$this, 'created'], $created);
        } else {
            $this->defaultAction(__FUNCTION__, $created);
        }
        return back();
    }

    /**
     * @param array $validated
     * @return array
     */
    public function validation(array $validated = [])
    {

        if (request()->hasFile('image')) {
            $validated['image'] = uploader(request()->file('image'));
        }

        return $validated;
    }

    /**
     * @param string $functionName
     * @param Model $model
     */
    public function defaultAction(string $functionName, Model $model)
    {
        alert()->success(ucfirst(class_basename($this->getModel())), ($model->name ?? $model->title ?? $model->id) . ' ' . __FUNCTION__);
        //return back();
    }

    /**
     * @param $id
     * @return RedirectResponse
     */

    public function update($id)
    {
        $model = $this->find($id);
        $validated = $this->validation(request()->validate($this->updateValidation ?? []));
        $model->update($validated);
        if (method_exists($this, 'updated')) {
            call_user_func([$this, 'updated'], $model);
        } else {
            $this->defaultAction(__FUNCTION__, $model);
        }
        return back();
    }

    /**
     * @param $id
     * @return RedirectResponse
     */
    public function destroy($id)
    {
        $model = $this->find($id);
        $oldValue = $model;
        try {
            $model->delete();
            if (method_exists($this, 'deleted')) {
                call_user_func([$this, 'deleted'], $oldValue);
            } else {
                $this->defaultAction(__FUNCTION__, $model);
            }
        } catch (Exception $e) {

        }
        return back();
    }

    /**
     * generate Parameters Values
     */
    public function setParametersValue(): void
    {
        $parameter = strtolower(class_basename($this->getModel()));
        $this->parameters = [
            "edit" => Str::singular($parameter),
            "index" => Str::plural($parameter),
        ];
    }
}
