<?php 

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Governrate;

class GovernratesController extends Controller
{

  /**
   * Display a listing of the resource.
   *
   * @return Response
   */
    public function __construct()
    {
        $this->middleware('auth');
    }

  public function index()
  {
     $records = Governrate::paginate(20);
     return view('governorates.index', compact('records'));
  }

  /**
   * Show the form for creating a new resource.
   *
   * @return Response
   */
  public function create()
  {
      return view('governorates.create');
  }

  /**
   * Store a newly created resource in storage.
   *
   * @return Response
   */
  public function store(Request $request)
  {
      $rules = [
          'name' => 'required'
      ];

      $messages = [];

      $this->validate($request, $rules, $messages);

//      $record = new Governrate;
//      $record->name = $request->input('name');
//      $record->save();

      $record = Governrate::create($request->all());
      flash()->success('Success add new Governrate');

      return redirect(route('governrates.index'));
  }

  /**
   * Display the specified resource.
   *
   * @param  int  $id
   * @return Response
   */
  public function show($id)
  {
    
  }

  /**
   * Show the form for editing the specified resource.
   *
   * @param  int  $id
   * @return Response
   */
  public function edit($id)
  {
      $model = Governrate::findOrFail($id);
      return view('governorates.edit', compact('model'));
  }

  /**
   * Update the specified resource in storage.
   *
   * @param  int  $id
   * @return Response
   */
  public function update(Request $request, $id)
  {
      $record = Governrate::findOrFail($id);
      $record->update($request->all());
      flash()->success('Edit Success');
      return back();
  }

  /**
   * Remove the specified resource from storage.
   *
   * @param  int  $id
   * @return Response
   */
  public function destroy($id)
  {
     $record = Governrate::findOrFail($id);
     $record->delete();
     flash()->success('Success Deleted');
     return back();
  }
  
}

?>
