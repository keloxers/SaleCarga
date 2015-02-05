<?php

class CategoriasController extends BaseController {


	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{

				$tiposcargas = DB::table('tiposcargas')
													->orderBy('id', 'desc')->paginate(20);

        return View::make('tiposcargas.ver', array(
						'tiposcargas' => $tiposcargas
				));
	}





	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
        return View::make('categorias.create');
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{

		$rules = [
			'categoria' => 'required'
		];

		if (! Categoria::isValid(Input::all(),$rules)) {

			return Redirect::back()->withInput()->withErrors(Categoria::$errors);

		}

		$categoria = new Categoria;


		$categoria->categoria = Input::get('categoria');
		$categoria->save();

		return Redirect::to('/categorias');

	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($url_seo)
	{

		$categoria = DB::table('categorias')->where('url_seo', '=', $url_seo)->first();;

		$id = $categoria->id;

		$categoria = categoria::find($id);

		$valor=rand(1, 3);
		$categoria->visitas = $categoria->visitas + $valor;
		$categoria->save();
		$categoria = Categoria::find($categoria->categorias_id);

		$archivos = DB::table('archivos')
			->where('padre', '=', 'categoria')
			->where('padre_id', '=', $categoria->id)
			->get();

			$talles = DB::table('talles')
			->where('categorias_id', '=', $categoria->id)
			->get();


		$categoriasrelacionados = DB::table('categorias')
											->where('estado', '=', 'publicado')
											->where('categorias_id', '=', $categoria->categorias_id)
											->where('id', '<>', $categoria->id)
											->where('created_at', '>=', new DateTime('-10 days'))
											->orderBy('visitas', 'desc')
											->paginate(4);


		// show the view and pass the nerd to it

		return View::make('categorias.show', array(
											'categoria' => $categoria,
											'categoriasrelacionados' => $categoriasrelacionados,
											'categoria' => $categoria,
											'archivos' => $archivos,
											'talles' => $talles,
											));
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		$categoria = Categoria::find($id);
		$title = "Editar Categoria";

        return View::make('categorias.edit', array('title' => $title, 'categoria' => $categoria));
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{



		$categoria = categoria::find($id);


		$rules = [
			'categoria' => 'required'
		];


		if (! Categoria::isValid(Input::all(),$rules)) {

			return Redirect::back()->withInput()->withErrors(Categoria::$errors);

		}

		$categoria->categoria = Input::get('categoria');

		$categoria->save();

		return Redirect::to('/categorias');


	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		$input = Input::all();

		$categoria = categoria::find($id)->delete();

		return Redirect::to('/categorias');
	}





		/**
		* Display a listing of the resource.
		*
		* @return Response
		*/
		public function categorias($categoria)
		{

			$categoria = DB::table('categorias')
			->where('categoria', '=', $categoria)->first();


			$categorias = DB::table('categorias')
			->where('estado', '=', 'publicado')
			->where('categorias_id', '=', $categoria->id)
			->orderBy('categoria', 'asc')
			->paginate(20);


			return View::make('categorias.showcategorias', array(
						'categorias' => $categorias,
						'categoria' => $categoria
					));

	}

















}
