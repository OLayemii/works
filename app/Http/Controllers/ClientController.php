<?php namespace App\Http\Controllers;
use App\EmployerCompany;
use App\EmployerDirector;
use Illuminate\Http\Request;
use Validator;
use Illuminate\Support\Facades\DB;
class ClientController extends Controller {
    public function __construct(EmployerCompany $company, EmployerDirector $director) {
        $this->company = $company;
        $this->director = $director;
    }
    public function index() {
        $company = $this->company->with('director')->get();
        // $director = $company->director;
        foreach ($company as $key => $com){
            $director = $com->director;
            $com->director_firstname  = $director->director_firstname;
            $com->director_lastname  = $director->director_lastname;
            $com->director_email  = $director->director_email;
            $com->director_phone  = $director->director_phone;

            unset($com->director);

            $companyArr[] = $com;
        }


        return response()->json([
            'message' => $companyArr
        ], 200);
    }

    public function store(Request $request) {
        $validator = Validator::make($request->all(), [
            'director_firstname' => 'required',
            'director_lastname' => 'required',
            'director_email' => 'required',
            'director_phone' => 'required',
            'company_name' => 'required',
            'company_address' => 'required',
            'company_phone_no' => 'required',
            'company_fax' => 'required',
            'company_city' => 'required',
            'company_province' => 'required',
            'company_followup_email' => 'required',
            'company_followup_contact' => 'required',
            'company_postal_code' => 'required',
            'company_notes' => 'required'
        ]);
        if ($validator->fails()) {
            return response()->json([
                'error' => 'Make sure all fields are entered.'
            ], 400);        }
        $position = new $this->position;
        $position->position_name = $request->input('position_name');
        $position->position_description = $request->input('position_description');
        $position->save();

        return response()->json([
            'message' => 'Client Created!.'
        ], 200);
        // return redirect()->route('customer.index');
    }

    public function edit($id) {
        $customer = $this->customer->query()->find($id);
        return view('customer.edit', ['customer' => $customer]);
    }

    public function update(Request $request) {
        $validator = Validator::make($request->all(), [
            'director_firstname' => 'required',
            'director_lastname' => 'required',
            'director_email' => 'required',
            'director_phone' => 'required',
            'company_name' => 'required',
            'company_address' => 'required',
            'company_phone_no' => 'required',
            'company_fax' => 'required',
            'company_city' => 'required',
            'company_province' => 'required',
            'company_followup_email' => 'required',
            'company_followup_contact' => 'required',
            'company_postal_code' => 'required',
            'company_notes' => 'required',
            'id' => "required"
        ]);
        if ($validator->fails()) {
            return response()->json([
                'message' => 'Fields cant be null!.'
            ], 400);
        }

        $id = $request->input('id');
        $company = $this->company->query()->findOrFail($id);
        $director = $this->director->query()->where('id', '=', $company->director_id)->first();

        try{
            DB::beginTransaction();
                $company->company_name = $request->input('company_name');
                $company->company_address = $request->input('company_address');
                $company->company_phone_no = $request->input('company_phone_no');
                $company->company_fax = $request->input('company_fax');
                $company->company_city = $request->input('company_city');
                $company->company_province = $request->input('company_province');
                $company->company_followup_email = $request->input('company_followup_email');
                $company->company_followup_contact = $request->input('company_followup_contact');
                $company->company_postal_code = $request->input('company_postal_code');
                $company->company_notes = $request->input('company_notes');
                $director->director_firstname = $request->input('director_firstname');
                $director->director_lastname = $request->input('director_lastname');
                $director->director_email = $request->input('director_email');
                $director->director_phone = $request->input('director_phone');

                $director->save();
                $company->save();
            DB::commit();
        }catch(\Exception $e){
            DB::rollback();
        }


        return response()->json([
            'message' => 'Client Updated!.'
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

        $this->position->query()->findOrFail($request->input('id'))->delete();
        return response()->json([
            'message' => 'Position Deleted!.'
        ], 200);
    }

}