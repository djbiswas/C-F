@extends('layouts.admin')

@section('content')

    <div style="margin: 0 15%;">

        <div class="card card-accent-primary mb-3 text-left mt-5" style="">
            <div class="card-header">Data Entry -
                @role('receiver')
                    Receiver Part
                @endrole
                @role('operator')
                    Operator Part
                @endrole
                @role('deliver')
                    Delivery Part
                @endrole
            </div>
            <div class="card-body text-primary">
                {{ Form::model($file_data, ['route' => ['file_datas.update', $file_data->id], 'method' => 'put','enctype' => 'multipart/form-data']) }}

                {{csrf_field()}}
                <div class="row">
                    @role('admin|receiver|operator|deliver')
                    <div class="form-group col-6">
                        {{Form::label('lodgement_no', 'Lodgement No')}}
                        <div class="input-group mb-3">
                            <span style="padding-top: 5px;padding-right: 10px">2020 - </span>{{Form::text('lodgement_no', null, array('class' => 'form-control', 'placeholder' => 'Lodgement No', 'required'  ))}}
                        </div>
                    </div>

                    <div class="form-group col-6">
                        {{Form::label('lodgement_date', 'Lodgement Date')}}
                        <div class="input-group mb-3">
                            {{Form::date('lodgement_date', \Carbon\Carbon::now(), array('class' => 'form-control', 'placeholder' => 'Lodgement Date', 'required'  ))}}
                        </div>
                    </div>

                    <div class="form-group col-6">
                        {{Form::label('manifest_no', 'Manifest No')}}
                        <div class="input-group mb-3">
                            {{Form::text('manifest_no', null, array('class' => 'form-control', 'placeholder' => 'Manifest No', 'required'  ))}}
                        </div>
                    </div>

                    <div class="form-group col-6">
                        {{Form::label('manifest_date', 'Manifest Date')}}
                        <div class="input-group mb-3">
                            {{Form::date('manifest_date', \Carbon\Carbon::now(), array('class' => 'form-control', 'placeholder' => 'Manifest Date', 'required'  ))}}
                        </div>
                    </div>

                    <div class="form-group col-6">
                        {{Form::label('agent_id', 'Select Agent')}}
                        <div class="input-group mb-3">
                            {{Form::select('agent_id', $agents, null, array('class' => 'form-control', 'placeholder' => 'Select Agent', 'required'  ))}}
                        </div>
                    </div>

                    <div class="form-group col-6">
                        {{Form::label('group', 'Group (Import/Export)')}}
                        <div class="input-group mb-3">
                            {{Form::text('group', null, array('class' => 'form-control', 'placeholder' => 'Group', 'required'  ))}}
                        </div>
                    </div>

                    {{--   End of receive part--}}
                    @endrole

                    @role('admin|operator|deliver')
                    <div class="card-accent-primary col-12 mb-3"></div>

                    <!-- Import / Export Input Form -->
                    <div class="form-group col-4">
                        {{Form::label('ie_type','File Type (Import / Export:) ') }} <br>
                        <div class="radio radio-inline">
                            <span> </span>
                            <label>
                                {{Form::radio('ie_type', 'Import', true)}} Import
                            </label>
                            <label>
                                {{Form::radio('ie_type', 'Export')}} Export
                            </label>

                        </div>
                    </div>

                    <div class="form-group col-4">
                        {{Form::label('ie_data_id', 'Select Importer / Exporter')}}
                        <div class="input-group mb-3">
                            {{Form::select('ie_data_id', $ie_datas, null, array('class' => 'form-control', 'placeholder' => 'Select Importer / Exporter', 'required'  ))}}
                        </div>
                    </div>


                    <div class="form-group col-4">
                        {{Form::label('goods_name', 'Goods Name')}}
                        <div class="input-group mb-3">
                            {{Form::text('goods_name', null, array('class' => 'form-control', 'placeholder' => 'Goods Name', 'required'  ))}}
                        </div>
                    </div>

                    <div class="form-group col-4">
                        {{Form::label('goods_type', 'Goods Type')}}
                        <div class="input-group mb-3">
                            {{Form::select('goods_type', ['Perishable'=>'Perishable','Non-Perishable'=>'Non-Perishable'], null, array('class' => 'form-control', 'placeholder' => 'Goods Type', 'required'  ))}}
                        </div>
                    </div>

                    <div class="form-group col-4">
                        {{Form::label('be_number', 'B/E Number')}}
                        <div class="input-group mb-3">
                            {{Form::text('be_number', $next_be_number, array('class' => 'form-control', 'placeholder' => 'B/E Number', 'required'  ))}}
                        </div>
                    </div>

                    <div class="form-group col-4">
                        {{Form::label('be_date', 'B/C Date')}}
                        <div class="input-group mb-3">
                            {{Form::date('be_date', \Carbon\Carbon::now(), array('class' => 'form-control', 'placeholder' => 'be_date ', 'required'  ))}}
                        </div>
                    </div>


                    <div class="form-group col-4">
                        {{Form::label('page', 'Pages')}}
                        <div class="input-group mb-3">
                            {{Form::number('page', null, array('class' => 'form-control', 'placeholder' => 'Pages', 'required'  ))}}
                        </div>
                    </div>

                    <div class="form-group col-4">
                        {{Form::label('fees', 'Fees /=')}}
                        <div class="input-group mb-3">
                            {{Form::number('fees', '230', array('class' => 'form-control', 'placeholder' => '230/=', 'required'  ))}}
                        </div>
                    </div>

                    @endrole

                    <hr>

                    <div class="form-group col-12">
                        <div class="text-right">
                            {{Form::submit('Submit', ['class' => 'btn btn-primary'])}}
                        </div>
                    </div>

                </div>
                {{ Form::close() }}
            </div>
        </div>



        {{--   End of Oprator part--}}

    </div>

@endsection

@section('scripts')
    <script>

    </script>

@endsection
