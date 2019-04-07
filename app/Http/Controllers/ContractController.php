<?php namespace App\Http\Controllers;
use App\Position;
use Illuminate\Http\Request;
use Validator;
class PositionController extends Controller {
    public function __construct(Position $position) {
        $this->position =$position;
    }
    public function index() {
        $positions = $this->position->query()->get();

        return response()->json([
            'message' => $positions
        ], 200);
    }

    public function store(Request $request) {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'description' => 'required',
        ]);
        if ($validator->fails()) {
            return response()->json([
                'error' => 'Make sure both fields are entered.'
            ], 400);        }
        $position = new $this->position;
        $position->position_name = $request->input('name');
        $position->position_description = $request->input('description');
        $position->save();

        return response()->json([
            'message' => 'Position Created!.'
        ], 200);
        // return redirect()->route('customer.index');
    }

    public function edit($id) {
        $customer = $this->customer->query()->find($id);
        return view('customer.edit', ['customer' => $customer]);
    }

    public function update(Request $request) {
        $validator = Validator::make($request->all(), [
            'position_name' => 'required',
            'position_description' => 'required',
        ]);
        if ($validator->fails()) {
            return response()->json([
                'message' => 'Position not Updated!.'
            ], 400);
        }

        $id = $request->input('id');
        $position = $this->position->query()->find($id);
        $position->position_name = $request->input('position_name');
        $position->position_description = $request->input('position_description');
        $position->save();

        return response()->json([
            'message' => 'Position Updated!.'
        ], 200);
    }
    public function destroy($id) {
        $this->position->query()->findOrFail($id)->delete();
        return response()->json([
            'message' => 'Position Deleted!.'
        ], 200);
    }
}