<?php

namespace OpenCompany\Integrations\Plaid\Tools;

/**
 * Gets transaction data in `cashflow_report`.
 *
 * Maps to the official Plaid endpoint post /cashflow_report/get.
 */
class PlaidCashflowReportGet extends AbstractPlaidTool
{
    protected const NAME = 'plaid_cashflow_report_get';
    protected const DESCRIPTION = 'Gets transaction data in `cashflow_report`

Official Plaid endpoint: POST /cashflow_report/get

The `/cashflow_report/get` endpoint retrieves transactions data associated with an item. Transactions data is standardized across financial institutions. Transactions are returned in reverse-chronological order, and the sequence of transaction ordering is stable and will not shift. Transactions are not immutable and can also be removed altogether by the institution; a removed transaction will no longer appear in `/transactions/get`. For more details, see [Pending and posted transactions](https://plaid.com/docs/transactions/transactions-data/#pending-and-posted-transactions). Due to the potentially large number of transactions associated with an Item, results are paginated. Manipulate the ...';
    protected const PARAMETERS = array (
  'body' =>
  array (
    'type' => 'object',
    'required' => true,
    'description' => 'JSON request body matching the official Plaid OpenAPI request schema for this operation.',
  ),
);
    protected const METHOD = 'post';
    protected const PATH = '/cashflow_report/get';
    protected const PATH_PARAMS = array (
);
    protected const BODY_REQUIRED = true;
}