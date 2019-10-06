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
