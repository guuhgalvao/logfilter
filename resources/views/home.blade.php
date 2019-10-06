@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="col-md-12 border-bottom mb-4 py-2">
                <div class="row justify-content-between">
                    <h3 class="">Logs</h3>
                    <div id="pg-header-right">
                        <button type="button" class="btn btn-dark" id="btn_Filter" data-toggle="collapse" data-target="#formFilter" aria-expanded="false">Filter</button>
                        <button type="button" class="btn btn-dark" id="btn_Sync">Sync</button>
                    </div>
                </div>
            </div>
            <div class="col-md-12 collapse" id="formFilter">
                <form action="{{ route('home') }}" method="POST" id="form_Filter">
                    @csrf
                    {{-- <div class="form-group row">
                        <label class="col-lg-1 col-form-label text-right" for="txt_Date">Data</label>
                        <div class="col-lg-3">
                            <input type="text" class="form-control" name="txt_Date" id="txt_Date" placeholder="Data">
                        </div>
                        <label class="col-lg-1 col-form-label text-right" for="txt_Date">Data</label>
                        <div class="col-lg-3">
                            <input type="text" class="form-control" name="txt_Date" id="txt_Date" placeholder="Data">
                        </div>
                        <label class="col-lg-1 col-form-label text-right" for="txt_Date">Data</label>
                        <div class="col-lg-3">
                            <input type="text" class="form-control" name="txt_Date" id="txt_Date" placeholder="Data">
                        </div>
                    </div> --}}
                    <div class="form-group row">
                        <div class="col-3">
                            <div class="input-group">
                                {{-- <div class="input-group-prepend">
                                    <span class="input-group-text">Date</span>
                                </div> --}}
                                <input type="text" aria-label="Start date" class="form-control" name="xdate_start" id="xdate_start" placeholder="Start Date">
                                <input type="text" aria-label="End date" class="form-control" name="xdate_end" id="xdate_end" placeholder="End Date">
                            </div>
                        </div>
                        <div class="col-3">
                            <div class="input-group">
                                <input type="text" aria-label="Start time" class="form-control" name="xtime_start" id="xtime_start" placeholder="Start Time">
                                <input type="text" aria-label="End time" class="form-control" name="xtime_end" id="xtime_end" placeholder="End Time">
                            </div>
                        </div>
                        <div class="col-3">
                            <select class="form-control" name="type" id="type">
                                <option value="" selected>Type</option>
                                @if (!empty($types))
                                    @foreach ($types as $type)
                                        <option value="{{ $type['type'] }}">{{ ucfirst($type['type']) }}</option>
                                    @endforeach
                                @endif
                            </select>
                        </div>
                        <div class="col-3">
                            <select class="form-control" name="subtype" id="subtype">
                                <option value="" selected>SubType</option>
                                @if (!empty($subtypes))
                                    @foreach ($subtypes as $subtype)
                                        <option value="{{ $subtype['subtype'] }}">{{ ucfirst($subtype['subtype']) }}</option>
                                    @endforeach
                                @endif
                            </select>
                        </div>
                    </div>
                    {{-- <div class="form-row">
                        <div class="form-group col-3">
                            <label for="txt_Date">Data</label>
                            <input type="text" class="form-control" name="txt_Date" id="txt_Date" placeholder="Data">
                        </div>
                        <div class="form-group col-3">
                            <label for="txt_Date">Data</label>
                            <input type="text" class="form-control" name="txt_Date" id="txt_Date" placeholder="Data">
                        </div>
                        <div class="form-group col-3">
                            <label for="txt_Date">Data</label>
                            <input type="text" class="form-control" name="txt_Date" id="txt_Date" placeholder="Data">
                        </div>
                        <div class="form-group col-3">
                            <label for="txt_Date">Data</label>
                            <input type="text" class="form-control" name="txt_Date" id="txt_Date" placeholder="Data">
                        </div>
                    </div> --}}
                    <div class="form-group">
                        <button type="button" class="btn btn-dark" id="btn_FilterLogs">Search</button>
                    </div>
                </form>
            </div>
            <div id="result_list">
                @if(!empty($logs) && count($logs) > 0)
                    <div class="table-responsive">
                        <table class="table table-striped table-borderless table-light" id="tb_Logs">
                            <thead class="bg-dark text-white">
                                <tr>
                                    <th style="min-width: 8vw;">Date</th>
                                    <th>Time</th>
                                    <th>Type</th>
                                    <th>SubType</th>
                                    <th>User</th>
                                    <th>Group</th>
                                    <th>srcIP</th>
                                    <th>srcINTF</th>
                                    <th>dstIP</th>
                                    <th>dstINTF</th>
                                    <th>HostName</th>
                                    <th>Profile</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($logs as $log)
                                    <tr>
                                        <td>{{ $log->xdate ?? '-' }}</td>
                                        <td>{{ str_replace(' ', '', $log->xtime) ?? '-' }}</td>
                                        <td>{{ $log->type ?? '-' }}</td>
                                        <td>{{ $log->subtype ?? '-' }}</td>
                                        <td>{{ $log->user ?? '-' }}</td>
                                        <td>{{ $log->group ?? '-' }}</td>
                                        <td>{{ $log->srcip ?? '-' }}</td>
                                        <td>{{ $log->srcintf ?? '-' }}</td>
                                        <td>{{ $log->dstip ?? '-' }}</td>
                                        <td>{{ $log->dstintf ?? '-' }}</td>
                                        <td>{{ $log->hostname ?? '-' }}</td>
                                        <td>{{ $log->profile ?? '-' }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div class="col-md-12 mt-2">
                        <div class="row justify-content-center">
                            {{ $logs->links() }}
                        </div>
                    </div>
                @else
                    <div class="col-md-12">
                        <div class="row">
                            <h4 class="text-secondary">Nenhum resultado encontrado!</h4>
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
    <script>
        jQuery(function($){
            function getList(page = 1, per_page = 15){
                showLoader(function(){
                    $('#form_Filter').ajaxSubmit({
                        url: '{{ route('home') }}?page='+page,
                        data:{actionType: 'filter', per_page: per_page},
                        success: function(response){
                            $('#result_list div').remove();
                            $('#result_list').html(response);
                            hideLoader(function(){});
                        }
                    });
                });
            }

            $(document).ready(function(){
                $('#xdate_start, #xdate_end').mask('0000-00-00');
                $('#xtime_start, #xtime_end').mask('00:00');

                $('#btn_Sync').on('click', function(){
                    showLoader(function(){
                        $.ajax({
                            type: 'POST',
                            headers: {
                                'X-CSRF-TOKEN': '{{ csrf_token() }}'
                            },
                            url: '{{ route('sync') }}',
                            dataType: 'json',
                            success: function(response){
                                hideLoader(function(){
                                    Swal.fire({
                                        title: response.message.text,
                                        type: response.message.type,
                                        confirmButtonText: 'OK'
                                    })
                                });
                            }
                        });
                    });
                });

                $('#btn_FilterLogs').on('click', function(){
                    getList();
                });

                $(document).on('click', '#result_list .pagination a', function(e){
                    e.preventDefault();
                    e.stopPropagation();
                    getList($(this).attr('href').split('page=')[1]);
                });
            });
        });
    </script>
@endsection
