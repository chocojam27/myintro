<?php

namespace App\Models\Page;

use Illuminate\Database\Eloquent\Model;

use DB;

class Page extends Model
{
    public static function addData($request)
    {
    	$data       = new self;
        $data->name = $request->page_name;
        $data->save();
        return $data->id;
    }

    public static function getData($id='none')
    {
    	if ($id != 'none') {
    		$data['self_data'] = self::find($id);
    		if (!empty($data['self_data'])) {
    			$data['page_content'] = DB::table('page_sections')
    										->join('page_contents','page_sections.id','=','page_contents.section_id')
    										->where('page_contents.page_id',$data['self_data']->id)
                                            ->orderBy('page_sections.id','asc')
                                            ->orderBy('page_contents.created_at','asc')
                                            ->get();
                $data['page_section'] = DB::table('page_sections')
    										->join('page_contents','page_sections.id','=','page_contents.section_id')
    										->where('page_contents.page_id',$data['self_data']->id)
    										->distinct()
    										->select('page_sections.name')
                                            ->orderBy('page_sections.id','asc')
                                            ->get();
    		}
    	}
    	return (object) $data;
    }
}
