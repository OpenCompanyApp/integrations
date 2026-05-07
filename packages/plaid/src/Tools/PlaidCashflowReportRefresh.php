<?php

namespace OpenCompany\Integrations\Plaid\Tools;

/**
 * Refresh transaction data in `cashflow_report`.
 *
 * Maps to the official Plaid endpoint post /cashflow_report/refresh.
 */
class PlaidCashflowReportRefresh extends AbstractPlaidTool
{
    protected const NAME = 'plaid_cashflow_report_refresh';
    protected const DESCRIPTION = 'Refresh transaction data in `cashflow_report`

Official Plaid endpoint: POST /cashflow_report/refresh

`/cashflow_report/refresh` is an endpoint that initiates an on-demand extraction to fetch the newest transactions for an item (given an `item_id`). The item must already have Cashflow Report added as a product in order to call `/cashflow_report/refresh`. After calling `/cashflow_report/refresh`, Plaid will fire a webhook `CASHFLOW_REPORT_READY` alerting clients that new transactions data can then be ingested via `/cashflow_report/get` or the webhook will contain an error code informing there was an error in refreshing transactions data. Note that the `/cashflow_report/refresh` endpoint is not supported for Capital One (`ins_128026`) non-depository accounts and will result in a `PRODUCTS_N...';
    protected const PARAMETERS = array (
  'body' =>
  array (
    'type' => 'object',
    'required' => true,
    'description' => 'JSON request body matching the official Plaid OpenAPI request schema for this operation.',
  ),
);
    protected const METHOD = 'post';
    protected const PATH = '/cashflow_report/refresh';
    protected const PATH_PARAMS = array (
);
    protected const BODY_REQUIRED = true;
}