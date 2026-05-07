<?php

namespace OpenCompany\Integrations\Plaid\Tools;

/**
 * Retrieve an Asset Report with Freddie Mac format (aka VOA - Verification Of Assets), and a Verification Of Employment (VOE) report if this one is available. Only Freddie Mac can use this endpoint..
 *
 * Maps to the official Plaid endpoint post /credit/freddie_mac/reports/get.
 */
class PlaidCreditFreddieMacReportsGet extends AbstractPlaidTool
{
    protected const NAME = 'plaid_credit_freddie_mac_reports_get';
    protected const DESCRIPTION = 'Retrieve an Asset Report with Freddie Mac format (aka VOA - Verification Of Assets), and a Verification Of Employment (VOE) report if this one is available. Only Freddie Mac can use this endpoint.

Official Plaid endpoint: POST /credit/freddie_mac/reports/get

The `credit/asset_report/freddie_mac/get` endpoint retrieves the Verification of Assets and Verification of Employment reports.';
    protected const PARAMETERS = array (
  'body' =>
  array (
    'type' => 'object',
    'required' => true,
    'description' => 'JSON request body matching the official Plaid OpenAPI request schema for this operation.',
  ),
);
    protected const METHOD = 'post';
    protected const PATH = '/credit/freddie_mac/reports/get';
    protected const PATH_PARAMS = array (
);
    protected const BODY_REQUIRED = true;
}