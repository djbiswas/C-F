<?php

namespace App\Http\Controllers;

use App\Models\Agent;
use App\Models\Data_user;
use App\Models\File_data;
use App\Models\User;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class Report extends Controller
{
    public function index()
    {
        //ie_datas
        $i = 0;
//        $file_datas = File_data::get();
        $agents = Agent::pluck('name','id');
        return view('reports.index',compact('agents','i'));
    }

    public function deliver_report()
    {
        //ie_datas
        $i = 0;
//        $file_datas = File_data::get();
        $agents = Agent::pluck('name','id');
        return view('reports.index',compact('agents','i'));
    }

//

    public function get_all_report(Request $request)
    {
        if (request()->ajax()) {
            if (!empty($request->from_date)) {
                $startdate = $request->from_date;
                $enddate = $request->to_date;
                $agent_id = $request->agent_id;

                $query = 'date(created_at) between "' . $startdate . '" AND "' . $enddate . '"';
                if ($agent_id == ''){
                    $file_datas = File_data::whereRaw($query)->where('status','Delivered')->with('agent')->with('ie_data')->get();
                }else {
                    $file_datas = File_data::whereRaw($query)->where('status','Delivered')->where('agent_id',$request->agent_id)->with('agent')->with('ie_data')->get();
                }

            } else {
//              $sales_date = Trip::orderBy('id', 'desc')->get();
//                $file_datas = File_data::with('agent')->with('ie_data')->get();
                $file_datas = File_data::where('status','Delivered')->with('agent')->with('ie_data')->get();
            }
            return DataTables::of($file_datas)->make(true);
        }
    }


    public function operator_report()
    {
        //ie_datas
        $i = 0;
//        $file_datas = File_data::get();
        $agents = Agent::pluck('name','id');
        return view('reports.operator',compact('agents','i'));
    }

    public function get_operator_report(Request $request)
    {
        if (request()->ajax()) {
            if (!empty($request->from_date)) {
                $startdate = $request->from_date;
                $enddate = $request->to_date;
                $agent_id = $request->agent_id;

                $query = 'date(lodgement_date) between "' . $startdate . '" AND "' . $enddate . '"';
                if ($agent_id == ''){
                    $file_datas = File_data::whereRaw($query)->where('status','!=','Received')->with('agent')->with('ie_data')->get();
                }else {
                    $file_datas = File_data::whereRaw($query)->where('status','!=','Received')->where('agent_id',$request->agent_id)->with('agent')->with('ie_data')->get();
                }

            } else {
//              $sales_date = Trip::orderBy('id', 'desc')->get();
//                $file_datas = File_data::with('agent')->with('ie_data')->get();
                $file_datas = File_data::where('status','!=','Received')->with('agent')->with('ie_data')->get();
            }
            return DataTables::of($file_datas)->make(true);
        }
    }



    public function receiver_report()
    {
        //ie_datas
        $i = 0;
//        $file_datas = File_data::get();
        $agents = Agent::pluck('name','id');
        return view('reports.receiver',compact('agents','i'));
    }

    public function get_receiver_report(Request $request)
    {
        if (request()->ajax()) {
            if (!empty($request->from_date)) {
                $startdate = $request->from_date;
                $enddate = $request->to_date;
                $agent_id = $request->agent_id;

                $query = 'date(lodgement_date) between "' . $startdate . '" AND "' . $enddate . '"';
                if ($agent_id == ''){
                    $file_datas = File_data::whereRaw($query)->with('agent')->with('ie_data')->get();
                }else {
                    $file_datas = File_data::whereRaw($query)->where('agent_id',$request->agent_id)->with('agent')->with('ie_data')->get();
                }

            } else {
//              $sales_date = Trip::orderBy('id', 'desc')->get();
//                $file_datas = File_data::with('agent')->with('ie_data')->get();
                $file_datas = File_data::with('agent')->with('ie_data')->get();
            }
            return DataTables::of($file_datas)->make(true);
        }
    }



    public function data_entry()
    {


        $i = 0;
        $users = User::where('id','!=','1')->pluck('name','id');
        return view('reports.data_entry',compact('users','i'));
    }

    public function get_data_entry(Request $request)
    {

//        return Data_user::with('file_data')->with('user')->get();
        if (request()->ajax()) {
            if (!empty($request->from_date)) {


                $startdate = $request->from_date;
                $enddate = $request->to_date;
                $agent_id = $request->agent_id;

                $query = 'date(lodgement_date) between "' . $startdate . '" AND "' . $enddate . '"';
                if ($agent_id == ''){
                    $file_datas = File_data::whereRaw($query)->where('status','!=','Received')->with('agent')->with('ie_data')->get();
                }else {
                    $file_datas = File_data::whereRaw($query)->where('status','!=','Received')->where('agent_id',$request->agent_id)->with('agent')->with('ie_data')->get();
                }

            } else {
//              $sales_date = Trip::orderBy('id', 'desc')->get();
//                $file_datas = File_data::with('agent')->with('ie_data')->get();
                $file_datas = Data_user::with('file_data')->with('user')->get();
            }
            return DataTables::of($file_datas)->make(true);
        }
    }



}
