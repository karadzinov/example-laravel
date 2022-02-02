<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Kalnoy\Nestedset\NodeTrait;

class Categories extends Model
{
    use HasFactory, NodeTrait;


    protected $table = 'categories';

    protected $fillable = [
        'name',
        'parent_id',
        '_lft',
        '_rgt'
    ];

    protected static $depth = 0;

    public static function getTree()
    {
        $categories = self::all();
        $lists = '<ul>';
        foreach ($categories as $category) {
            if ($category['parent_id'] === null) {
                $lists .= self::renderNode($category);
            }
        }
        $lists .= "</ul>";
        return $lists;
    }

    public static function renderNode($node)
    {
        $list = '<li><a href="/admin/categories/' . $node->id . '/edit">' . $node->name . '</a>
                <a href="/admin/categories/' . $node->id . '/delete"> <span class="text-danger">x</span> </a>
            </li>';
        $children = self::where('parent_id', '=', $node->id)->get();
        $count = $children->count();
        if ($count > 0) {
            $list .= '<ul>';
            foreach ($children as $child) {
                $list .= self::renderNode($child);
            }
            $list .= "</ul>";
        }
        return $list;
    }

    public static function getTreeHP()
    {
        $categories = self::all();

        $lists = '';
        foreach ($categories as $category) {
            if ($category['parent_id'] === null) {
                $lists .= self::renderNodeHP($category);
            }
        }

        return $lists;
    }

    public static function renderNodeHP($node)
    {
        $list = '<li class="dropdown-item dropdown"><a href="/categories/'.$node->id.'" class="dropdown-link" data-toggle="dropdown">' . $node->name . '</a>';
        $children = self::where('parent_id', '=', $node->id)->get();
        $count = $children->count();
        if ($count > 0) {
            $list .= '<ul class="dropdown-menu dropdown-menu-hover dropdown-menu-block-md shadow-lg b-0 m-0">';
            foreach ($children as $child) {

                $list .= self::renderNodeHP($child);

            }

            $list .= '</li></ul>';

        }





        return $list;


    }





    public static function getList()
    {
        $categories = self::all();
        $lists = '';
        foreach ($categories as $category) {
            if ($category->parent_id === null) {
                $lists .= self::renderOption($category);
            }
        }
        return $lists;
    }

    public static function renderOption($node)
    {
        $list = '<option value="' . $node->id . '">' . self::dash(self::$depth) . ' '.$node->name . '</option>';
        $children = self::where('parent_id', '=', $node->id)->get();
        $count = $children->count();
        if ($count > 0) {
            self::$depth++;
            foreach ($children as $child) {
                $list .= self::renderOption($child);
            }
            self::$depth--;
        }
        return $list;
    }

    private static function dash($depth)
    {
        $dash = '';
        for ($i = 1; $i <= $depth; $i++) {
            $dash .= ' - ';
        }
        return $dash;
    }

}
