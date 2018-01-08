<?php

namespace App\Http\Controllers\Laboratory;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\LaboratoryJobs;
use DB;
use App\Models\LaboratoryJobStatus;

class LaboratoryJobsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $res = LaboratoryJobs
            ::select(
                // 'ljs.status_id',
                // 'ljs.created_at AS ljs_created_at',
                'lj.*',
                'ljt.value AS type'
            )
            ->from('laboratory_jobs AS lj')
            ->leftJoin('laboratory_job_types AS ljt', 'lj.type_id', 'ljt.id')
            // ->leftJoin('laboratory_job_status AS ljs', 'ljs.laboratory_job_id', 'lj.id')

            // busqueda
            ->where('lj.description', 'LIKE', "%".request()->get('search')."%")
            ->orWhere('lj.id', 'LIKE', "%".request()->get('search')."%")
            ->orWhere('lj.charge', 'LIKE', "%".request()->get('search')."%")
            ->orWhere('lj.deliver', 'LIKE', "%".request()->get('search')."%")
            ->orWhere('ljt.value', 'LIKE', "%".request()->get('search')."%")
            // busqueda

            // ->groupBy('lj.id')
            ->orderBy('lj.id', 'DESC')
            ->paginate(config('laboratory.per_page'));

        // cargar estado
        foreach($res->items() as &$item){
            $queryStatus = DB::table('laboratory_job_status')
                ->where('laboratory_job_id', $item->id)
                ->orderBy('id', 'DESC');
            
            $list_status = $queryStatus->get();
            $last_status = $queryStatus->first();
            

            // dd($list_status);

            if($last_status){
                $item->status_id = $last_status->status_id;
                $item->ljs_created_at = $last_status->created_at;
            }
            $item->status_list = $list_status;
        }
        
        return $res;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $reg = new LaboratoryJobs;
        $reg->charge = $request->charge;
        $reg->deliver = $request->deliver;
        $reg->description = $request->description;
        $reg->observation = $request->observation;
        $reg->type_id = $request->type_id;
        $reg->clinic_doctor_name = $request->clinic_doctor_name;
        $reg->clinic_patient_name = $request->clinic_patient_name;
        $reg->user_id = auth()->user()->id;
        $reg->save();

        $status = new LaboratoryJobStatus;
        // $status->status_id = request()->status_id;
        $status->laboratory_job_id = $reg->id;
        $status->user_id = auth()->user()->id;
        $status->save();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $reg = LaboratoryJobs::find($id);
        $reg->charge = $request->charge;
        $reg->deliver = $request->deliver;
        $reg->description = $request->description;
        $reg->observation = $request->observation;
        $reg->type_id = $request->type_id;
        $reg->clinic_doctor_name = $request->clinic_doctor_name;
        $reg->clinic_patient_name = $request->clinic_patient_name;
        $reg->user_id = auth()->user()->id;
        $reg->save();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        LaboratoryJobs::destroy($id);
    }
}
