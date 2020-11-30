<?php

namespace App\Http\Controllers;

use App\Models\Agent;
use App\Models\Data_user;
use App\Models\File_data;
use App\Models\Ie_data;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;

class FileDataController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $i = 0;
        $file_datas = File_data::with('agent')->with('ie_data')->get();
        return view('file_datas.index', compact('file_datas','i'));
    }

    public function file_list()
    {
        $i = 0;
        $file_datas = File_data::get();
        return view('file_datas.index', compact('file_datas','i'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        $now = Carbon::now();
        $year = $now->year;

        $file_data = File_data::latest()->first();
        $next_lodgement_no = $file_data->lodgement_no + 1;

        $agents = Agent::pluck('name','id');
        return view('file_datas.create',compact('agents','next_lodgement_no','year'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'lodgement_no' => 'required',
            'lodgement_date' => 'required',
            'manifest_no' => 'required',
            'manifest_date' => 'required',
            'agent_id' => 'sometimes',
            'group' => 'sometimes',
            'note' => 'sometimes'
        ]);

        $file_data = new File_data();
        $file_data->lodgement_no = $request->lodgement_no;
        $file_data->lodgement_date = $request->lodgement_date;
        $file_data->manifest_no = $request->manifest_no;
        $file_data->manifest_date = $request->manifest_date;
        $file_data->agent_id = $request->agent_id;
        $file_data->group = $request->group;
        $file_data->status = 'Received';
        //$file_data->note = $request->note;
        $file_data->save();

        $data_user = new Data_user();
        $data_user->file_data_id = $file_data->id;
        $data_user->user_id = Auth::user()->id;
        $data_user->note = Auth::user()->name;
        $data_user->save();

        flash('New File Receive Success.')->success();

        return redirect()->route('file_datas.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\File_data  $file_data
     * @return \Illuminate\Http\Response
     */
    public function show(File_data $file_data)
    {
        return view('file_datas.show',compact('file_data'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\File_data  $file_data
     * @return \Illuminate\Http\Response
     */
    public function edit(File_data $file_data)
    {
        $now = Carbon::now();
        $year = $now->year;

        if($file_data->be_number != ''){
             $next_be_number = $file_data->be_number +1;
        }else {
            $next_be_number = File_data::where('status','!=','Received')->latest()->first();
            $next_be_number = $next_be_number->be_number + 1;
        }



        $agents = Agent::pluck('name','id');
        $ie_datas = Ie_data::pluck('name','id');
        return view('file_datas.edit',compact('file_data','agents','ie_datas','year','next_be_number'));
    }

    public function file_edit(File_data $file_data)
    {
        $agents = Agent::pluck('name','id');
        return view('file_datas.file_edit',compact('file_data','agents'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\File_data  $file_data
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, File_data $file_data)
    {
        if( Auth::user()->hasRole('receiver')){
            $this->validate($request, [
                'lodgement_no' => 'required',
                'lodgement_date' => 'required',
                'manifest_no' => 'required',
                'manifest_date' => 'required',
                'agent_id' => 'required',
                'group' => 'required'
            ]);

            $file_data->lodgement_no = $request->lodgement_no;
            $file_data->lodgement_date = $request->lodgement_date;
            $file_data->manifest_no = $request->manifest_no;
            $file_data->manifest_date = $request->manifest_date;
            $file_data->agent_id = $request->agent_id;
            $file_data->group = $request->group;
            $file_data->save();
        }

        if( Auth::user()->hasRole('operator')){
            $this->validate($request, [
                'lodgement_no' => 'required',
                'lodgement_date' => 'required',
                'manifest_no' => 'required',
                'manifest_date' => 'required',
                'ie_type' => 'required',
                'ie_data_id' => 'required',
                'agent_id' => 'required',
                'group' => 'required',
                'goods_name' => 'required',
                'goods_type' => 'required',
                'be_number' => 'required',
                'be_date' => 'required',
                'page' => 'required',
                'fees' => 'required'
            ]);

            $file_data->lodgement_no = $request->lodgement_no;
            $file_data->lodgement_date = $request->lodgement_date;
            $file_data->manifest_no = $request->manifest_no;
            $file_data->manifest_date = $request->manifest_date;
            $file_data->ie_type = $request->ie_type;
            $file_data->ie_data_id = $request->ie_data_id;
            $file_data->agent_id = $request->agent_id;
            $file_data->group = $request->group;
            $file_data->goods_name = $request->goods_name;
            $file_data->goods_type = $request->goods_type;
            $file_data->be_number = $request->be_number;
            $file_data->be_date = $request->be_date;
            $file_data->page = $request->page;
            $file_data->fees = $request->fees;
            $file_data->status = 'Operated';
            $file_data->save();

            $file_data_check = Data_user::where('file_data_id',$file_data->id)->where('user_id',Auth::user()->id)->get();

            if (count($file_data_check) == '0'){
                $data_user = new Data_user();
                $data_user->file_data_id = $file_data->id;
                $data_user->user_id = Auth::user()->id;
                $data_user->note = Auth::user()->name;
                $data_user->save();
            }

        }

        if( Auth::user()->hasRole('admin|deliver')){
            $this->validate($request, [
                'lodgement_no' => 'required',
                'lodgement_date' => 'required',
                'manifest_no' => 'required',
                'manifest_date' => 'required',
                'ie_type' => 'required',
                'ie_data_id' => 'required',
                'agent_id' => 'required',
                'group' => 'required',
                'goods_name' => 'required',
                'goods_type' => 'required',
                'be_number' => 'required',
                'be_date' => 'required',
                'page' => 'required',
                'fees' => 'required'
            ]);

            $file_data->lodgement_no = $request->lodgement_no;
            $file_data->lodgement_date = $request->lodgement_date;
            $file_data->manifest_no = $request->manifest_no;
            $file_data->manifest_date = $request->manifest_date;
            $file_data->ie_type = $request->ie_type;
            $file_data->ie_data_id = $request->ie_data_id;
            $file_data->agent_id = $request->agent_id;
            $file_data->group = $request->group;
            $file_data->goods_name = $request->goods_name;
            $file_data->goods_type = $request->goods_type;
            $file_data->be_number = $request->be_number;
            $file_data->be_date = $request->be_date;
            $file_data->page = $request->page;
            $file_data->fees = $request->fees;
            $file_data->status = 'Delivered';
            $file_data->save();

            $file_data_check = Data_user::where('file_data_id',$file_data->id)->where('user_id',Auth::user()->id)->get();
            if (count($file_data_check) == '0'){
                $data_user = new Data_user();
                $data_user->file_data_id = $file_data->id;
                $data_user->user_id = Auth::user()->id;
                $data_user->note = Auth::user()->name;
                $data_user->save();
            }
        }


        flash('Received File Update Success.')->success();
        return redirect()->route('file_datas.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\File_data  $file_data
     * @return \Illuminate\Http\Response
     */

    public function destroy(File_data $file_data)
    {
        //
    }
}
