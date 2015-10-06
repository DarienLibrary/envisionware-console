<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Config;
use DB;

class ReportsController extends Controller
{

    // TODO Add date ranges
    private function posTransactionSummary($posStationDB, $startDate, $endDate)
    {
        Config::set('database.default', 'sqlsrv');
        Config::set('database.connections.sqlsrv.database', env($posStationDB));

        $posSQL = "SELECT master.ControlNo, LineTotal, Description, master.TransactionDateTime, master.Total
  	        FROM [$posStationDB].[dbo].[TransactionDetail] AS detail
  	        LEFT OUTER JOIN [$posStationDB].[dbo].[TransactionMaster] AS master
  	        ON detail.ControlNo=master.ControlNo
  	        WHERE [TransactionDateTime] BETWEEN ? AND ?";

        return DB::select($posSQL, [$startDate, $endDate]);
    }

    // TODO Add date ranges
    // TODO All the kiosk forms
    private function kioskTransactionSummary($kioskStationID, $startDate, $endDate)
    {
        Config::set('database.default', 'mysql');

        $kioskSQL = "SELECT ecstransaction.id AS tid, terminalId,
		    FROM_UNIXTIME(timestamp) AS txtime, ecsdebit.debitType AS dtype, ecscredit.creditType AS ctype,
		    ecsdebit.amount AS damount, ecscredit.amount AS camount
		    FROM dbauthentication.ecstransaction
		    LEFT OUTER JOIN (ecsdebit, ecscredit) ON (ecstransaction.id=ecsdebit.transaction_id
		    AND ecstransaction.id=ecscredit.transaction_id)
		    WHERE FROM_UNIXTIME(timestamp) >= ?
		    AND FROM_UNIXTIME(timestamp) <= ?
		    AND terminalId = ?
		    ORDER BY txtime ASC;";

        return DB::select($kioskSQL, [ $startDate, $endDate, $kioskStationID ]);
    }

    public function wdTxReport()
    {
        $formName = 'welcomedesk';
        $formDesc = 'Welcome Desk transaction summary report';

        return view('pages/reports/posTxReportForm', compact('formName', 'formDesc'));
    }

    public function hdTxReport()
    {
        $formName = 'helpdesk';
        $formDesc = 'Help Desk transaction summary report';

        return view('pages/reports/posTxReportForm', compact('formName', 'formDesc'));
    }

    public function cafeTxReport()
    {
        $formName = 'cafe';
        $formDesc = 'Cafe transaction summary report';

        return view('pages/reports/posTxReportForm', compact('formName', 'formDesc'));
    }

    public function wdTxReportDisp()
    {
        return $this->posTransactionSummary(env('MS_DB_DATABASE_WELCOMEDESK'));
    }

    public function hdTxReportDisp()
    {
        return $this->posTransactionSummary(env('MS_DB_DATABASE_HELPDESK'));
    }

    public function cafeTxReportDisp()
    {
        return $this->posTransactionSummary(env('MS_DB_DATABASE_CAFE'));
    }
}
