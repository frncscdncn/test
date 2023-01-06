<?php

namespace App\Filters;

class ProductFilter extends QueryFilter {

    public function category_id($id = null) {
        return $this->builder->when($id, function($query) use ($id) {
            $query->where('category_id', $id);
        });
    }
    
    public function subcategory_id($id = null) {
        return $this->builder->when($id, function($query) use ($id) {
            $query->where('subcategory_id', $id);
        });
    }

    public function subsubcategory_id($id = null) {
        return $this->builder->when($id, function($query) use ($id) {
            $query->where('subsubcategory_id', $id);
        });
    }
    
    public function search($search = '') {
        return $this->builder->where('slug', 'LIKE', '%'.$search.'%');
    }

    public function priceFrom($value = null) {
        return $this->builder->when($value, function($query) use ($value) {
            $query->where('price', '>', $value);
        });
    }
    
    public function priceTo($value = null) {
        return $this->builder->when($value, function($query) use ($value) {
            $query->where('price', '<', $value);
        });
    }

    public function widthFrom($value = null) {
        return $this->builder->when($value, function($query) use ($value) {
            $query->where('width', '>', $value);
        });
    }
    
    public function widthTo($value = null) {
        return $this->builder->when($value, function($query) use ($value) {
            $query->where('width', '<', $value);
        });
    }

    public function lengthFrom($value = null) {
        return $this->builder->when($value, function($query) use ($value) {
            $query->where('length', '>', $value);
        });
    }
    
    public function lengthTo($value = null) {
        return $this->builder->when($value, function($query) use ($value) {
            $query->where('length', '<', $value);
        });
    }

    public function weightFrom($value = null) {
        return $this->builder->when($value, function($query) use ($value) {
            $query->where('weight', '>', $value);
        });
    }
    
    public function weightTo($value = null) {
        return $this->builder->when($value, function($query) use ($value) {
            $query->where('weight', '<', $value);
        });
    }
}