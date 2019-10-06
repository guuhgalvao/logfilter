<?php

namespace App\Http\Controllers;

use App\Models\Log;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('home', ['logs' => Log::paginate(10)->onEachSide(2), 'types' => Log::select('type')->groupBy('type')->get(), 'subtypes' => Log::select('subtype')->groupBy('subtype')->get()]);
    }

    public function filter(Request $request)
    {
        // dd($logsFiltered);
        $logs = (new Log)->newQuery();
        if (!empty($request->input('xdate_start')) && !empty($request->input('xdate_end'))) {
            $logs->whereBetween('xdate', [$request->input('xdate_start'), $request->input('xdate_end')]);
        }
        if (!empty($request->input('xtime_start')) && !empty($request->input('xtime_end'))) {
            $logs->whereBetween('xtime', ["{$request->input('xtime_start')}:00", "{$request->input('xtime_end')}:00"]);
        }
        if (!empty($request->input('type'))) {
            $logs->where('type', $request->input('type'));
        }
        if (!empty($request->input('subtype'))) {
            $logs->where('subtype', $request->input('subtype'));
        }
        return view('filter', ['logs' => $logs->paginate(10)->onEachSide(2)]);
    }

    public function sync()
    {
        $logs = file(storage_path('app/public/logs/syslog.log'));

        $logsFiltered = [];
        foreach ($logs as $row) {
            $log = trim(strval($row));
            $logSplited = explode(',', substr($log, strpos($log, 'date=')));

            $logFiltered = [];
            foreach ($logSplited as $logInfo) {
                $infoSplited = explode('=', $logInfo);
                $logFiltered[trim($infoSplited[0])] = $infoSplited[1];
            }

            $logsFiltered[] = $logFiltered;
        }

        foreach ($logsFiltered as $log) {
            $logDB = Log::firstOrNew(['logid' => $log['logid'], 'sessionid' => $log['sessionid']]);
            if (empty($logDB->id)) {
                $logDB->xdate = trim($log['date']) ?? '';
                $logDB->xtime = str_replace(' ', '', trim($log['time'])) ?? '';
                $logDB->type = $log['type'] ?? '';
                $logDB->subtype = $log['subtype'] ?? '';
                $logDB->user = $log['user'] ?? '';
                $logDB->group = $log['group'] ?? '';
                $logDB->srcip = $log['srcip'] ?? '';
                $logDB->srcintf = $log['srcintf'] ?? '';
                $logDB->dstip = $log['dstip'] ?? '';
                $logDB->dstintf = $log['dstintf'] ?? '';
                $logDB->hostname = $log['hostname'] ?? '';
                $logDB->profile = $log['profile'] ?? '';
                $logDB->save();
            }
        }
        // dd($logsFiltered);
        $response['error'] = false;
        $response['message'] = ['type' => 'success', 'text' => 'Sincronizado!'];
        return $response;
    }
}
