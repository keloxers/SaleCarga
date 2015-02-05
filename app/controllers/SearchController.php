<?php

class SearchController extends BaseController {


	public function ciudads(){
		$term = Input::get('term');

		$results = array();

		$queries = DB::table('ciudads')
		->where('ciudad', 'LIKE', '%'.$term.'%')
		->take(7)->get();

		foreach ($queries as $query)
		{

			$provincia = Provincia::find($query->provincias_id);

			$results[] = [ 'id' => $query->id, 'value' => $query->ciudad . ", " . $provincia->provincia];
		}
		return Response::json($results);
	}


}
