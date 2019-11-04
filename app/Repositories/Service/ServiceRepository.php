<?php

namespace App\Repositories\Service;

use App\Models\Category;
use App\Models\Service;
use App\Models\Unit;
use App\Repositories\EloquentRepository;

class ServiceRepository extends EloquentRepository
{
    public function getModel()
    {
        return Service::class;
    }

    public function storeService($data)
    {
        $data['image'] = uploadImage('services', $data['image']);
        $data['lang_id'] = config('common.languages.default');
        $this->_model->create($data);
    }

    public function makeDataTable()
    {
        $services = $this->_model->with('category')->where('lang_id', session('locale'))->orderBy('id', 'desc')->get();
        $categories = Category::where('type', Category::SERVICE)->get();
        foreach ($services as $service) {
            if (session('locale') == config('common.languages.default')) {
                $service->cate_name = $service->getAttribute('category')->name;
            } else {
                $category = $service->getAttribute('category');
                $child = $categories->where('lang_id', session('locale'))->where('lang_parent_id', $category->id)->first();
                $service->cate_name = $child->name;
            }
        }

        return $services;
    }

    public function translate($data, $id)
    {
        $service = $this->_model->find($id);
        $data['lang_parent_id'] = $id;
        $data['image'] = $service->image;
        $data['unit_id'] = $service->unit_id;
        $data['cate_id'] = $service->cate_id;
        $this->_model->create($data);
    }

    public function checkUnitTranslate($service, $lang_id)
    {
        $unit_id = $service->unit_id;
        $unit = Unit::where('lang_id', $lang_id)->where('lang_parent_id', $unit_id)->first();

        if ($unit) {
            return true;
        }

        return false;
    }

    public function checkCateTranslate($service, $lang_id)
    {
        $cate_id = $service->cate_id;
        $category = Category::where('lang_id', $lang_id)->where('lang_parent_id', $cate_id)->where('type', Category::SERVICE)->first();

        if ($category) {
            return true;
        }

        return false;
    }

    public function getServiceByType($type)
    {
        $services = $this->_model
            ->with('langChildren')
            ->where('lang_parent_id', 0)
            ->whereHas('langChildren', function ($query) {
                $query->where('lang_id', session('locale'));
            })
            ->get();
        if ($type == config('common.currency.en')) {
            foreach ($services as $service) {
                $service->name = $service->getAttribute('langChildren')[0]->name;
                $service->price = $service->getAttribute('langChildren')[0]->price;
            }
        }

        return $services;

    }
}