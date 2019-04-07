<?php namespace App\Http\Controllers;
use App\Candidate;
use Illuminate\Http\Request;
use Validator;
class CandidateController extends Controller {
    public function __construct(Candidate $candidate) {
        $this->candidate =$candidate;
    }
    public function index() {
        $candidates = $this->candidate->query()->orderBy('date_created', 'desc')->get();

        return response()->json([
            'message' => $candidates
        ], 200);
    }

    public function store(Request $request) {
        $validator = Validator::make($request->all(), [
            'first_name' => 'required',
            'last_name' => 'required',
            'email' => 'required',
            'homephone' => 'required',
            'mobile_number' => 'required',
            'date_of_birth' => 'required',
            'street' => 'required',
            'city' => 'required',
            'province' => 'required',
            'postal_code' => 'required',
        ]);
        if ($validator->fails()) {
            return response()->json([
                'error' => 'Make sure all fields are entered.'
            ], 400);        }
        $candidate = new $this->candidate;
        $candidate->first_name = $request->input('first_name');
        $candidate->last_name = $request->input('last_name');
        $candidate->email = $request->input('email');
        $candidate->homephone = $request->input('homephone');
        $candidate->mobile_number = $request->input('mobile_number');
        $candidate->date_of_birth = $request->input('date_of_birth');
        $candidate->street = $request->input('street');
        $candidate->city = $request->input('city');
        $candidate->province = $request->input('province');
        $candidate->postal_code = $request->input('postal_code');
        $candidate->emp_country = "1";
        $candidate->passport = "passport";
        $candidate->home_address = $request->input('home_address');
        $candidate->save();

        return response()->json([
            'message' => 'candidate Created!.'
        ], 200);
        // return redirect()->route('customer.index');
    }

    public function edit($id) {
        $customer = $this->customer->query()->find($id);
        return view('customer.edit', ['customer' => $customer]);
    }

    public function update(Request $request) {
        $validator = Validator::make($request->all(), [
            'first_name' => 'required',
            'last_name' => 'required',
            'email' => 'required',
            'homephone' => 'required',
            'mobile_number' => 'required',
            'date_of_birth' => 'required',
            'street' => 'required',
            'city' => 'required',
            'province' => 'required',
            'postal_code' => 'required',
        ]);
        if ($validator->fails()) {
            return response()->json([
                'message' => 'Fields cant be null!.'
            ], 400);
        }

        $id = $request->input('id');
        $candidate = $this->candidate->query()->find($id);
        $candidate->first_name = $request->input('first_name');
        $candidate->last_name = $request->input('last_name');
        $candidate->email = $request->input('email');
        $candidate->homephone = $request->input('homephone');
        $candidate->mobile_number = $request->input('mobile_number');
        $candidate->date_of_birth = $request->input('date_of_birth');
        $candidate->street = $request->input('street');
        $candidate->city = $request->input('city');
        $candidate->province = $request->input('province');
        $candidate->postal_code = $request->input('postal_code');
        $candidate->emp_country = "1";
        $candidate->home_address = $request->input('home_address');
        $candidate->passport = "passport";
        $candidate->save();

        return response()->json([
            'message' => 'candidate Updated!.'
        ], 200);
    }

    public function delete(Request $request) {
        $validator = Validator::make($request->all(), [
            'id' => 'required',
        ]);
        if ($validator->fails()) {
            return response()->json([
                'message' => 'Id for delete not specified!.'
            ], 400);
        }

        $this->candidate->query()->findOrFail($request->input('id'))->delete();
        return response()->json([
            'message' => 'candidate Deleted!.'
        ], 200);
    }

}