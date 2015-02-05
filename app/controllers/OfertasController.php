<?php

class OfertasController extends BaseController {


	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{

				$users_id = Sentry::getUser()->id;

        $ofertas = DB::table('ofertas')
													->where('users_id', '=', $users_id)
													->orderBy('id', 'desc')
													->get();

        return View::make('ofertas.index', array('ofertas' => $ofertas));

	}


/**
* Display a listing of the resource.
*
* @return Response
*/
public function home()
{

			$ofertas = DB::table('ofertas')->orderBy('id', 'desc')->paginate(10);

			$ofertas_mas_vistas = DB::table('ofertas')
														->where('estado', '=', 'oferta')
														->orderBy('visitas', 'desc')
														->paginate(10);

			$title = "Cargas disponibles ahora !";

			return View::make('home', array('title' => $title, 'ofertas' => $ofertas, 'ofertas_mas_vistas' => $ofertas_mas_vistas));

}


/**
* Display a listing of the resource.
*
* @return Response
*/
public function showtiposcargas($tiposcarga)
{

			$tiposcargas = DB::table('tiposcargas')
			->where('tiposcarga', '=', $tiposcarga)
			->first();

			$ofertas = DB::table('ofertas')
														->where('tiposcargas_id', '=', $tiposcargas->id)
														->orderBy('id', 'desc')
														->paginate(15);

			$ofertas_mas_vistas = DB::table('ofertas')
														->where('estado', '=', 'oferta')
														->where('tiposcargas_id', '=', $tiposcargas->id)
														->orderBy('visitas', 'desc')
														->paginate(10);


			$title = "Cargas: " . $tiposcargas->tiposcarga;
			return View::make('home', array('title' => $title, 'ofertas' => $ofertas, 'ofertas_mas_vistas' => $ofertas_mas_vistas));
}




	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
        return View::make('ofertas.create');
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{



/*
		var_dump(Input::all());



		die;


/*

origen_id
destino_id

tiposcargas_id
fecha
kilos
importe


'fecha' =>'date|date_format:d/m/Y|after:01/01/2015',

*/


		$rules = [
			'origen_id' => 'exists:ciudads,id',
			'destino_id' => 'exists:ciudads,id',
			'tiposcargas_id' => 'exists:tiposcargas,id',
			'fecha' =>'date_format:d/m/Y',
			'kilos' => 'required|numeric',
			'importe' => 'required|numeric',
		];


		if (! Oferta::isValid(Input::all(),$rules)) {

			return Redirect::back()->withInput()->withErrors(Oferta::$errors);

		}

		$oferta = new Oferta;

		$fecha = Input::get('fecha');
		$fecha = date("Y-m-d",strtotime(str_replace('/','-',$fecha)));


		$oferta->users_id = Sentry::getUser()->id;
		$oferta->tiposcargas_id = Input::get('tiposcargas_id');
		$oferta->origen_id = Input::get('origen_id');
		$oferta->destino_id = Input::get('destino_id');
		$oferta->fecha = $fecha;
		$oferta->kilos = Input::get('kilos',0);
		$oferta->importe = Input::get('importe',0);

		$oferta->estado = 'oferta';

		$myStr = str_random(5);

		$url_seo = "carga_desde_" . Ciudad::find($oferta->origen_id)->ciudad . "_hasta_". Ciudad::find($oferta->destino_id)->ciudad . "_" . $myStr;

		$url_seo = $this->url_slug($url_seo);

		$oferta->url_seo = $url_seo;

		// $producto->url_seo = $url_seo;


		$oferta->save();

		return Redirect::to('/ofertas');

	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($url_seo)
	{

		$oferta = DB::table('ofertas')->where('url_seo', '=', $url_seo)->first();

		$id = $oferta->id;

		$oferta = Oferta::find($id);

		$oferta->visitas = $oferta->visitas + 1;
		$oferta->save();

		$user = Sentry::findUserById($oferta->users_id);

		$ofertasrelacionadas = DB::table('ofertas')->where('tiposcargas_id', '=', $oferta->tiposcargas_id)->paginate(4);

		$ofertas_mas_vistas = DB::table('ofertas')
													->where('estado', '=', 'oferta')
													->orderBy('visitas', 'desc')
													->paginate(10);


		return View::make('ofertas.show', array(
											'oferta' => $oferta,
											'user' => $user,
											'ofertasrelacionadas' => $ofertasrelacionadas,
											'ofertas_mas_vistas' => $ofertas_mas_vistas
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
		$producto = producto::find($id);
		$title = "Editar producto";

        return View::make('productos.edit', array('title' => $title, 'producto' => $producto));
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{



		$producto = producto::find($id);


		$rules = [
			'producto' => 'required',
			'texto' => 'required',
		];


		if (! Producto::isValid(Input::all(),$rules)) {

			return Redirect::back()->withInput()->withErrors(Producto::$errors);

		}

		$producto->users_id = Sentry::getUser()->id;
		$producto->tipo = Input::get('tipo');
		$producto->categorias_id = Input::get('categorias_id');
		$producto->producto = Input::get('producto');
		$producto->texto = Input::get('texto');
		$producto->descripcion = Input::get('descripcion');
		$producto->comentarios = Input::get('comentarios');
		$producto->precio_anterior = Input::get('precio_anterior',0);
		$producto->precio_publico = Input::get('precio_publico',0);
		$url_seo = Input::get('producto');




		$url_seo = $this->url_slug($url_seo) . implode("-",getdate());
		$url_seo = $this->url_slug($url_seo) . date('ljSFY');


		$producto->url_seo = $url_seo;


		$producto->save();

		return Redirect::to('/productos/ver');


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


		$producto = producto::find($id)->delete();

		return Redirect::to('/productos');
	}


/**
* Remove the specified resource from storage.
*
* @param  int  $id
* @return Response
*/
public function publicar($id)
{

	$producto = producto::find($id);
	$producto->estado = 'publicado';
	$producto->save();

	return Redirect::to('/productos/ver');
}


/**
* Remove the specified resource from storage.
*
* @param  int  $id
* @return Response
*/
public function cancelar($id)
{

	$producto = producto::find($id);
	$producto->estado = 'cancelado';
	$producto->save();

	return Redirect::to('/productos/ver');
}



    public function search(){

        $term = Input::get('term');

        $productos = DB::table('productos')->where('producto', 'like', '%' . $term . '%')->get();

        $adevol = array();

        if (count($productos) > 0) {

            foreach ($productos as $producto)
                {
                	$precio_sin_iva = $producto->precio_publico / (($producto->iva / 100) + 1);

                    $adevol[] = array(
                        'id' => $producto->id,
                        'value' => $producto->producto,
                        'precio' => $precio_sin_iva,
                        'iva' => $producto->iva,
                    );
            }
        } else {
                    $adevol[] = array(
                        'id' => 0,
                        'value' => 'no hay coincidencias para: ' .  $term,
                        'precio' => 0,
                        'iva' => 0,
                    );
        }

        return json_encode($adevol);


    }







		public function url_slug($str, $options = array()) {
			// Make sure string is in UTF-8 and strip invalid UTF-8 characters
			$str = mb_convert_encoding((string)$str, 'UTF-8', mb_list_encodings());

			$defaults = array(
				'delimiter' => '-',
				'limit' => null,
				'lowercase' => true,
				'replacements' => array(),
				'transliterate' => false,
			);

			// Merge options
			$options = array_merge($defaults, $options);

			$char_map = array(
				// Latin
				'À' => 'A', 'Á' => 'A', 'Â' => 'A', 'Ã' => 'A', 'Ä' => 'A', 'Å' => 'A', 'Æ' => 'AE', 'Ç' => 'C',
				'È' => 'E', 'É' => 'E', 'Ê' => 'E', 'Ë' => 'E', 'Ì' => 'I', 'Í' => 'I', 'Î' => 'I', 'Ï' => 'I',
				'Ð' => 'D', 'Ñ' => 'N', 'Ò' => 'O', 'Ó' => 'O', 'Ô' => 'O', 'Õ' => 'O', 'Ö' => 'O', 'Ő' => 'O',
				'Ø' => 'O', 'Ù' => 'U', 'Ú' => 'U', 'Û' => 'U', 'Ü' => 'U', 'Ű' => 'U', 'Ý' => 'Y', 'Þ' => 'TH',
				'ß' => 'ss',
				'à' => 'a', 'á' => 'a', 'â' => 'a', 'ã' => 'a', 'ä' => 'a', 'å' => 'a', 'æ' => 'ae', 'ç' => 'c',
				'è' => 'e', 'é' => 'e', 'ê' => 'e', 'ë' => 'e', 'ì' => 'i', 'í' => 'i', 'î' => 'i', 'ï' => 'i',
				'ð' => 'd', 'ñ' => 'n', 'ò' => 'o', 'ó' => 'o', 'ô' => 'o', 'õ' => 'o', 'ö' => 'o', 'ő' => 'o',
				'ø' => 'o', 'ù' => 'u', 'ú' => 'u', 'û' => 'u', 'ü' => 'u', 'ű' => 'u', 'ý' => 'y', 'þ' => 'th',
				'ÿ' => 'y',

				// Latin symbols
				'©' => '(c)',

				// Greek
				'Α' => 'A', 'Β' => 'B', 'Γ' => 'G', 'Δ' => 'D', 'Ε' => 'E', 'Ζ' => 'Z', 'Η' => 'H', 'Θ' => '8',
				'Ι' => 'I', 'Κ' => 'K', 'Λ' => 'L', 'Μ' => 'M', 'Ν' => 'N', 'Ξ' => '3', 'Ο' => 'O', 'Π' => 'P',
				'Ρ' => 'R', 'Σ' => 'S', 'Τ' => 'T', 'Υ' => 'Y', 'Φ' => 'F', 'Χ' => 'X', 'Ψ' => 'PS', 'Ω' => 'W',
				'Ά' => 'A', 'Έ' => 'E', 'Ί' => 'I', 'Ό' => 'O', 'Ύ' => 'Y', 'Ή' => 'H', 'Ώ' => 'W', 'Ϊ' => 'I',
				'Ϋ' => 'Y',
				'α' => 'a', 'β' => 'b', 'γ' => 'g', 'δ' => 'd', 'ε' => 'e', 'ζ' => 'z', 'η' => 'h', 'θ' => '8',
				'ι' => 'i', 'κ' => 'k', 'λ' => 'l', 'μ' => 'm', 'ν' => 'n', 'ξ' => '3', 'ο' => 'o', 'π' => 'p',
				'ρ' => 'r', 'σ' => 's', 'τ' => 't', 'υ' => 'y', 'φ' => 'f', 'χ' => 'x', 'ψ' => 'ps', 'ω' => 'w',
				'ά' => 'a', 'έ' => 'e', 'ί' => 'i', 'ό' => 'o', 'ύ' => 'y', 'ή' => 'h', 'ώ' => 'w', 'ς' => 's',
				'ϊ' => 'i', 'ΰ' => 'y', 'ϋ' => 'y', 'ΐ' => 'i',

				// Turkish
				'Ş' => 'S', 'İ' => 'I', 'Ç' => 'C', 'Ü' => 'U', 'Ö' => 'O', 'Ğ' => 'G',
				'ş' => 's', 'ı' => 'i', 'ç' => 'c', 'ü' => 'u', 'ö' => 'o', 'ğ' => 'g',

				// Russian
				'А' => 'A', 'Б' => 'B', 'В' => 'V', 'Г' => 'G', 'Д' => 'D', 'Е' => 'E', 'Ё' => 'Yo', 'Ж' => 'Zh',
				'З' => 'Z', 'И' => 'I', 'Й' => 'J', 'К' => 'K', 'Л' => 'L', 'М' => 'M', 'Н' => 'N', 'О' => 'O',
				'П' => 'P', 'Р' => 'R', 'С' => 'S', 'Т' => 'T', 'У' => 'U', 'Ф' => 'F', 'Х' => 'H', 'Ц' => 'C',
				'Ч' => 'Ch', 'Ш' => 'Sh', 'Щ' => 'Sh', 'Ъ' => '', 'Ы' => 'Y', 'Ь' => '', 'Э' => 'E', 'Ю' => 'Yu',
				'Я' => 'Ya',
				'а' => 'a', 'б' => 'b', 'в' => 'v', 'г' => 'g', 'д' => 'd', 'е' => 'e', 'ё' => 'yo', 'ж' => 'zh',
				'з' => 'z', 'и' => 'i', 'й' => 'j', 'к' => 'k', 'л' => 'l', 'м' => 'm', 'н' => 'n', 'о' => 'o',
				'п' => 'p', 'р' => 'r', 'с' => 's', 'т' => 't', 'у' => 'u', 'ф' => 'f', 'х' => 'h', 'ц' => 'c',
				'ч' => 'ch', 'ш' => 'sh', 'щ' => 'sh', 'ъ' => '', 'ы' => 'y', 'ь' => '', 'э' => 'e', 'ю' => 'yu',
				'я' => 'ya',

				// Ukrainian
				'Є' => 'Ye', 'І' => 'I', 'Ї' => 'Yi', 'Ґ' => 'G',
				'є' => 'ye', 'і' => 'i', 'ї' => 'yi', 'ґ' => 'g',

				// Czech
				'Č' => 'C', 'Ď' => 'D', 'Ě' => 'E', 'Ň' => 'N', 'Ř' => 'R', 'Š' => 'S', 'Ť' => 'T', 'Ů' => 'U',
				'Ž' => 'Z',
				'č' => 'c', 'ď' => 'd', 'ě' => 'e', 'ň' => 'n', 'ř' => 'r', 'š' => 's', 'ť' => 't', 'ů' => 'u',
				'ž' => 'z',

				// Polish
				'Ą' => 'A', 'Ć' => 'C', 'Ę' => 'e', 'Ł' => 'L', 'Ń' => 'N', 'Ó' => 'o', 'Ś' => 'S', 'Ź' => 'Z',
				'Ż' => 'Z',
				'ą' => 'a', 'ć' => 'c', 'ę' => 'e', 'ł' => 'l', 'ń' => 'n', 'ó' => 'o', 'ś' => 's', 'ź' => 'z',
				'ż' => 'z',

				// Latvian
				'Ā' => 'A', 'Č' => 'C', 'Ē' => 'E', 'Ģ' => 'G', 'Ī' => 'i', 'Ķ' => 'k', 'Ļ' => 'L', 'Ņ' => 'N',
				'Š' => 'S', 'Ū' => 'u', 'Ž' => 'Z',
				'ā' => 'a', 'č' => 'c', 'ē' => 'e', 'ģ' => 'g', 'ī' => 'i', 'ķ' => 'k', 'ļ' => 'l', 'ņ' => 'n',
				'š' => 's', 'ū' => 'u', 'ž' => 'z'
			);

			// Make custom replacements
			$str = preg_replace(array_keys($options['replacements']), $options['replacements'], $str);

			// Transliterate characters to ASCII
			if ($options['transliterate']) {
				$str = str_replace(array_keys($char_map), $char_map, $str);
			}

			// Replace non-alphanumeric characters with our delimiter
			$str = preg_replace('/[^\p{L}\p{Nd}]+/u', $options['delimiter'], $str);

			// Remove duplicate delimiters
			$str = preg_replace('/(' . preg_quote($options['delimiter'], '/') . '){2,}/', '$1', $str);

			// Truncate slug to max. characters
			$str = mb_substr($str, 0, ($options['limit'] ? $options['limit'] : mb_strlen($str, 'UTF-8')), 'UTF-8');

			// Remove delimiter from ends
			$str = trim($str, $options['delimiter']);

			return $options['lowercase'] ? mb_strtolower($str, 'UTF-8') : $str;
		}


}
