<?php

namespace App\Http\Controllers;

use Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Config;
use DB;

class ReportsController extends Controller
{

    /**
     * @param $posStationDB
     * @param $startDate
     * @param $endDate
     * @return array
     */
    private function posMdseTransactionSummary($posStationDB, $startDate, $endDate)
    {
        Config::set('database.default', 'sqlsrv');
        Config::set('database.connections.sqlsrv.database', env($posStationDB));

        $tendered = ['CA' => 0, 'CC' => 0, 'CH' => 0, 'AM' => 0, 'total' => 0];
        $reportData = [];
        $reportTotals = $tendered;

        $lineItemQuery = "SELECT master.ControlNo, LineTotal, Description, master.TransactionDateTime, master.Total
  	        FROM [$posStationDB].[dbo].[TransactionDetail] AS detail
  	        LEFT OUTER JOIN [$posStationDB].[dbo].[TransactionMaster] AS master
  	        ON detail.ControlNo=master.ControlNo
  	        WHERE [TransactionDateTime] BETWEEN ? AND ?";

        $lineItemResult = DB::select($lineItemQuery, [$startDate . ' 00:00:00', $endDate . ' 23:59:59']);

        foreach ($lineItemResult as $lineItem) {
            if (!isset($reportData[$lineItem->Description])) {
                $reportData[$lineItem->Description] = $tendered;
            }

            $paymentsQuery = "SELECT PaymentCode, Amount
                FROM [$posStationDB].[dbo].[TransactionPayments]
                WHERE ControlNo = ?";
            $paymentsResult = DB::select($paymentsQuery, [$lineItem->ControlNo]);

            foreach ($paymentsResult as $payment) {
                if ($payment->PaymentCode != 'CX') {
                    $reportData[$lineItem->Description][$payment->PaymentCode] += $lineItem->LineTotal;
                    $reportData[$lineItem->Description]['total'] += $lineItem->LineTotal;
                    $reportTotals[$payment->PaymentCode] += $lineItem->LineTotal;
                    $reportTotals['total'] += $lineItem->LineTotal;
                }
            }
        }

        return compact('reportData', 'reportTotals');
    }

    /**
     * @param $kioskStationID
     * @param $startDate
     * @param $endDate
     * @return array
     */
    private function kioskTransactionSummary($kioskStationID, $startDate, $endDate)
    {
        Config::set('database.default', 'mysql');

        $reportData = [];
        $reportTotals = ['cash' => 0, 'aam' => 0, 'credit' => 0, 'total' => 0];

        $kioskTransactionSQL = "SELECT ecstransaction.id AS tid, terminalId,
		    FROM_UNIXTIME(timestamp) AS txtime, ecsdebit.debitType AS dtype, ecscredit.creditType AS ctype,
		    ecsdebit.amount AS damount, ecscredit.amount AS camount
		    FROM dbauthentication.ecstransaction
		    LEFT OUTER JOIN (ecsdebit, ecscredit) ON (ecstransaction.id=ecsdebit.transaction_id
		    AND ecstransaction.id=ecscredit.transaction_id)
		    WHERE ecsdebit.debitType IS NOT NULL
		    AND FROM_UNIXTIME(timestamp) >= ?
		    AND FROM_UNIXTIME(timestamp) <= ?
		    AND terminalId = ?
		    ORDER BY txtime ASC;";

        $kioskTransactionResult = DB::select($kioskTransactionSQL, [$startDate, $endDate, $kioskStationID]);

        foreach ($kioskTransactionResult as $kioskTransaction) {
            if (!isset($reportData[$kioskTransaction->tid])) {
                $reportData[$kioskTransaction->tid] = array(
                    'desc'   => $kioskTransaction->ctype,
                    'time'   => $kioskTransaction->txtime,
                    'cash'   => 0,
                    'aam'    => 0,
                    'credit' => 0,
                    'total'  => 0,
                );
            }

            switch ($kioskTransaction->dtype) {
                case 'Cash - CoinOp':
                    $reportData[$kioskTransaction->tid]['cash'] += $kioskTransaction->camount;
                    $reportTotals['cash'] += $kioskTransaction->camount;
                    break;
                case 'AAM Deposit':
                    $reportData[$kioskTransaction->tid]['aam'] += $kioskTransaction->camount;
                    $reportTotals['aam'] += $kioskTransaction->camount;
                    break;
                case 'Credit Card':
                    $reportData[$kioskTransaction->tid]['credit'] += $kioskTransaction->camount;
                    $reportTotals['credit'] += $kioskTransaction->camount;
                    break;
            }
            $reportData[$kioskTransaction->tid]['total'] += $kioskTransaction->camount;
            $reportTotals['total'] += $kioskTransaction->camount;
        }

        return compact('reportData', 'reportTotals');
    }

    public function wdMdseTxReport()
    {
        $formName = 'welcomedesk';
        $formDesc = 'Welcome Desk merchandise transaction summary report';

        return view('pages/reports/TxReportFormDate', compact('formName', 'formDesc'));
    }

    public function hdMdseTxReport()
    {
        $formName = 'helpdesk';
        $formDesc = 'Help Desk merchandise transaction summary report';

        return view('pages/reports/TxReportFormDate', compact('formName', 'formDesc'));
    }

    public function cafeMdseTxReport()
    {
        $formName = 'cafe';
        $formDesc = 'Cafe merchandise transaction summary report';

        return view('pages/reports/TxReportFormDate', compact('formName', 'formDesc'));
    }

    public function kioskKLSTxReport()
    {
        $formName = 'kioskKLS';
        $formDesc = 'KLS payment kiosk transaction summary report';

        return view('pages/reports/TxReportFormDateTime', compact('formName', 'formDesc'));
    }

    public function kioskBCTxReport()
    {
        $formName = 'kioskBC';
        $formDesc = 'Business Center payment kiosk transaction summary report';

        return view('pages/reports/TxReportFormDateTime', compact('formName', 'formDesc'));
    }

    public function kioskPLTxReport()
    {
        $formName = 'kioskPL';
        $formDesc = 'Power Library transaction summary report';

        return view('pages/reports/TxReportFormDateTime', compact('formName', 'formDesc'));
    }

    public function kioskWebTxReport()
    {
        $formName = 'kioskWeb';
        $formDesc = 'Web transaction summary report';

        return view('pages/reports/TxReportFormDateTime', compact('formName', 'formDesc'));
    }

    public function ldsKLSTxReport()
    {
        $formName = 'ldsKLS';
        $formDesc = 'KLS library document station transaction summary report';

        return view('pages/reports/TxReportFormDateTime', compact('formName', 'formDesc'));
    }

    public function ldsBCTxReport()
    {
        $formName = 'ldsBC';
        $formDesc = 'Business Center library document station transaction summary report';

        return view('pages/reports/TxReportFormDateTime', compact('formName', 'formDesc'));
    }

    public function wdMdseTxReportDisp()
    {
        $input = Request::all();
        $reportDataSet = $this->posMdseTransactionSummary(env('MS_DB_DATABASE_WELCOMEDESK'), $input['startDate'], $input['endDate']);

        return view('pages/reports/TxReportMerchandise', compact('input', 'reportDataSet'));
    }

    public function hdMdseTxReportDisp()
    {
        $input = Request::all();
        $reportDataSet = $this->posMdseTransactionSummary(env('MS_DB_DATABASE_HELPDESK'), $input['startDate'], $input['endDate']);

        return view('pages/reports/TxReportMerchandise', compact('input', 'reportDataSet'));
    }

    public function cafeMdseTxReportDisp()
    {
        $input = Request::all();
        $reportDataSet = $this->posMdseTransactionSummary(env('MS_DB_DATABASE_CAFE'), $input['startDate'], $input['endDate']);

        return view('pages/reports/TxReportMerchandise', compact('input', 'reportDataSet'));
    }

    public function kioskKLSTxReportDisp()
    {
        $input = Request::all();
        $reportDataSet = $this->kioskTransactionSummary(env('KIOSK_HOSTNAME_KLS'), $input['startDate'], $input['endDate']);

        return view('pages/reports/TxReportKiosk', compact('input', 'reportDataSet'));
    }

    public function kioskBCTxReportDisp()
    {
        $input = Request::all();
        $reportDataSet = $this->kioskTransactionSummary(env('KIOSK_HOSTNAME_BC'), $input['startDate'], $input['endDate']);

        return view('pages/reports/TxReportKiosk', compact('input', 'reportDataSet'));
    }

    public function kioskPLTxReportDisp()
    {
        $input = Request::all();
        $reportDataSet = $this->kioskTransactionSummary(env('KIOSK_HOSTNAME_PL'), $input['startDate'], $input['endDate']);

        return view('pages/reports/TxReportKiosk', compact('input', 'reportDataSet'));
    }

    public function kioskWebTxReportDisp()
    {
        $input = Request::all();
        $reportDataSet = $this->kioskTransactionSummary(env('KIOSK_HOSTNAME_WEB'), $input['startDate'], $input['endDate']);

        return view('pages/reports/TxReportKiosk', compact('input', 'reportDataSet'));
    }

    public function ldsKLSTxReportDisp()
    {
        return "Not yet implemented";
    }

    public function ldsBCTxReportDisp()
    {
        return "Not yet implemented";
    }
}
