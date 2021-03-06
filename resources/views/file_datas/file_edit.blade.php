@extends('layouts.admin')

@section('content')

    <div style="margin: 0 15%;">
        @role('admin|receiver|deliver')
        <div class="card card-accent-primary mb-3 text-left" style="">
            <div class="card-header">Data Entry - File Receive</div>
            <div class="card-body text-primary">
                {!! Form::open(['route' => 'file_datas.store', 'method' => 'post', 'enctype' => 'multipart/form-data' ]) !!}

                {{csrf_field()}}
                <div class="row">

                    <div class="form-group col-6">
                        {{Form::label('lodgement_no', 'Lodgement No')}}
                        <div class="input-group mb-3">
                            {{Form::text('lodgement_no', '202012001', array('class' => 'form-control', 'placeholder' => 'Lodgement No', 'required','readonly'  ))}}
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
                        {{Form::label('agent_id', 'Agent Name')}}
                        <div class="input-group mb-3">
                            {{Form::select('agent_id', $agents, null, array('class' => 'form-control', 'placeholder' => 'Select Agent name', 'required'  ))}}
                        </div>
                    </div>

                    <div class="form-group col-6">
                        {{Form::label('group', 'Group')}}
                        <div class="input-group mb-3">
                            {{Form::number('group', null, array('class' => 'form-control', 'placeholder' => '0000', 'required'  ))}}
                        </div>
                    </div>


                    <!-- Note Input Form -->
                    {{--            <div class="form-group">--}}
                    {{--                {{Form::label('note','Note:') }}--}}
                    {{--                {{Form::textarea('note', null, ['class' => 'form-control', 'rows' =>5, 'placeholder' => 'Note']) }}--}}
                    {{--            </div>--}}

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
        @endrole
        {{--   End of receive part--}}
        @role('admin|operator')
        <div class="card card-accent-primary mb-3 text-left mt-5" style="">
            <div class="card-header">Data Entry - Operator Part</div>
            <div class="card-body text-primary">
                {!! Form::open(['route' => 'file_datas.store', 'method' => 'post', 'enctype' => 'multipart/form-data' ]) !!}

                {{csrf_field()}}
                <div class="row">

                    <div class="form-group col-4">
                        {{Form::label('manufest_no', 'Manufest No')}}
                        <div class="input-group mb-3">
                            {{Form::select('agent_id', ['45454'=>'45454','454154'=>'454542'], null, array('class' => 'form-control', 'placeholder' => 'Select Manufest No', 'required'  ))}}
                        </div>
                    </div>

                    <div class="form-group col-4">
                        {{Form::label('logement_no', 'Logement No')}}
                        <div class="input-group mb-3">
                            {{Form::text('logement', '202012001', array('class' => 'form-control', 'placeholder' => 'Logement No', 'required', 'readonly' ))}}
                        </div>
                    </div>

                    <div class="form-group col-4">
                        {{Form::label('logement_date', 'Logement Date')}}
                        <div class="input-group mb-3">
                            {{Form::date('logement_date', \Carbon\Carbon::now(), array('class' => 'form-control', 'placeholder' => 'Logement Date', 'required' , 'readonly' ))}}
                        </div>
                    </div>

                    <div class="form-group col-4">
                        {{Form::label('importer_name', 'Importer Name')}}
                        <div class="input-group mb-3">
                            {{Form::text('importer_name', null, array('class' => 'form-control', 'placeholder' => 'Importer Name', 'required'  ))}}
                        </div>
                    </div>

                    <div class="form-group col-4">
                        {{Form::label('type', 'Type(Import/Export)')}}
                        <div class="input-group mb-3">
                            {{Form::select('type', ['Import','Export'], null, array('class' => 'form-control', 'placeholder' => 'Select Type', 'required'  ))}}
                        </div>
                    </div>

                    <div class="form-group col-4">
                        {{Form::label('group', 'Group(Import/Export)')}}
                        <div class="input-group mb-3">
                            {{Form::number('group', null, array('class' => 'form-control', 'placeholder' => '0000', 'required'  ))}}
                        </div>
                    </div>

                    <div class="form-group col-6">
                        {{Form::label('group', 'Goods')}}
                        <div class="input-group mb-3">
                            {{Form::number('goods', null, array('class' => 'form-control', 'placeholder' => 'Goods', 'required'  ))}}
                        </div>
                    </div>

                    <div class="form-group col-6">
                        {{Form::label('goods_type', 'Goods Type')}}
                        <div class="input-group mb-3">
                            {{Form::select('goods_type', ['Perishable','Non-Perishable'], null, array('class' => 'form-control', 'placeholder' => 'Goods Type', 'required'  ))}}
                        </div>
                    </div>

                    <div class="form-group col-4">
                        {{Form::label('bc_number', 'B/C Number')}}
                        <div class="input-group mb-3">
                            {{Form::text('goods', null, array('class' => 'form-control', 'placeholder' => 'B/C Number', 'required'  ))}}
                        </div>
                    </div>

                    <div class="form-group col-4">
                        {{Form::label('bc_date', 'B/C Date')}}
                        <div class="input-group mb-3">
                            {{Form::date('logement_date', \Carbon\Carbon::now(), array('class' => 'form-control', 'placeholder' => 'Logement Date', 'required' , 'readonly' ))}}
                        </div>
                    </div>


                    <div class="form-group col-4">
                        {{Form::label('fees', 'Fees /=')}}
                        <div class="input-group mb-3">
                            {{Form::number('goods', '230', array('class' => 'form-control', 'placeholder' => '230/=', 'required'  ))}}
                        </div>
                    </div>

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
        @endrole
        {{--   End of Oprator part--}}
        @role('admin|deliver')
        <div class="card card-accent-primary mb-3 text-left" style="">
            <div class="card-header">Data Entry - Delivery</div>
            <div class="card-body text-primary">
                {!! Form::open(['route' => 'file_datas.store', 'method' => 'post', 'enctype' => 'multipart/form-data' ]) !!}

                {{csrf_field()}}
                <div class="row">

                    <div class="form-group col-3">
                        {{Form::label('manufest_no', 'Manufest No')}}
                        <div class="input-group mb-3">
                            {{Form::select('agent_id', ['45454'=>'45454','454154'=>'454542'], null, array('class' => 'form-control', 'placeholder' => 'Select Manufest No', 'required'  ))}}
                        </div>
                    </div>

                    <div class="form-group col-3">
                        {{Form::label('manufest_date', 'Manufest Date')}}
                        <div class="input-group mb-3">
                            {{Form::date('logement_date', \Carbon\Carbon::now(), array('class' => 'form-control', 'placeholder' => 'Logement Date', 'required', 'readonly'  ))}}
                        </div>
                    </div>

                    <div class="form-group col-3">
                        {{Form::label('logement_no', 'Logement No')}}
                        <div class="input-group mb-3">
                            {{Form::text('logement', '202012001', array('class' => 'form-control', 'placeholder' => 'Logement No', 'required','readonly'  ))}}
                        </div>
                    </div>

                    <div class="form-group col-3">
                        {{Form::label('logement_date', 'Logement Date')}}
                        <div class="input-group mb-3">
                            {{Form::date('logement_date', \Carbon\Carbon::now(), array('class' => 'form-control', 'placeholder' => 'Logement Date', 'required', 'readonly'  ))}}
                        </div>
                    </div>

                    <div class="form-group col-3">
                        {{Form::label('agent_id', 'Agent Name')}}
                        <div class="input-group mb-3">
                            {{Form::text('agent_id',  'Agent 1', array('class' => 'form-control', 'placeholder' => 'Agent name', 'required', 'readonly'  ))}}
                        </div>
                    </div>

                    <div class="form-group col-3">
                        {{Form::label('group', 'Group')}}
                        <div class="input-group mb-3">
                            {{Form::number('group', null, array('class' => 'form-control', 'placeholder' => '0000', 'required'  ))}}
                        </div>
                    </div>

                    <div class="form-group col-3">
                        {{Form::label('importer_name', 'Importer Name')}}
                        <div class="input-group mb-3">
                            {{Form::text('importer_name', 'Importer Name', array('class' => 'form-control', 'placeholder' => 'Importer Name', 'required'  ))}}
                        </div>
                    </div>

                    <div class="form-group col-3">
                        {{Form::label('type', 'Type(Import/Export)')}}
                        <div class="input-group mb-3">
                            {{Form::text('type', 'Import / Export', array('class' => 'form-control', 'placeholder' => 'Select Type', 'required'  ))}}
                        </div>
                    </div>

                    <div class="form-group col-3">
                        {{Form::label('goods', 'Goods Name')}}
                        <div class="input-group mb-3">
                            {{Form::text('goods', 'Importer Name', array('class' => 'form-control', 'placeholder' => 'Goods Name', 'required'  ))}}
                        </div>
                    </div>

                    <div class="form-group col-3">
                        {{Form::label('group', 'Group Type')}}
                        <div class="input-group mb-3">
                            {{Form::number('group', null, array('class' => 'form-control', 'placeholder' => 'Perishable / Non-Perishable', 'required'  ))}}
                        </div>
                    </div>

                    <div class="form-group col-3">
                        {{Form::label('bc_number', 'B/C Number')}}
                        <div class="input-group mb-3">
                            {{Form::text('goods', null, array('class' => 'form-control', 'placeholder' => 'B/C Number', 'required'  ))}}
                        </div>
                    </div>

                    <div class="form-group col-3">
                        {{Form::label('bc_date', 'B/C Date')}}
                        <div class="input-group mb-3">
                            {{Form::date('logement_date', \Carbon\Carbon::now(), array('class' => 'form-control', 'placeholder' => 'Logement Date', 'required' , 'readonly' ))}}
                        </div>
                    </div>

                    <div class="form-group col-4"></div>

                    <div class="form-group col-4">
                        {{Form::label('fees', 'Fees')}}
                        <div class="input-group mb-3">
                            {{Form::text('fees', null, array('class' => 'form-control', 'placeholder' => '230/=', 'required' , 'readonly' ))}}
                        </div>
                    </div>
                    <div class="form-group col-4"></div>

                    <div class="form-group col-12">
                        <div class="text-right">
                            {{Form::submit('Delivery', ['class' => 'btn btn-primary'])}}
                        </div>
                    </div>

                </div>
                {{ Form::close() }}
            </div>
        </div>
        @endrole
    </div>

@endsection

@section('scripts')
    <script>

    </script>

@endsection
