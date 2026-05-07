<?php

namespace OpenCompany\Integrations\Plaid\Tools;

/**
 * Retrieve an Asset Report with Freddie Mac format. Only Freddie Mac can use this endpoint..
 *
 * Maps to the official Plaid endpoint post /credit/asset_report/freddie_mac/get.
 */
class PlaidCreditAssetReportFreddieMacGet extends AbstractPlaidTool
{
    protected const NAME = 'plaid_credit_asset_report_freddie_mac_get';
    protected const DESCRIPTION = 'Retrieve an Asset Report with Freddie Mac format. Only Freddie Mac can use this endpoint.

Official Plaid endpoint: POST /credit/asset_report/freddie_mac/get

The `credit/asset_report/freddie_mac/get` endpoint retrieves the Asset Report in Freddie Mac\'s JSON format.';
    protected const PARAMETERS = array (
  'body' =>
  array (
    'type' => 'object',
    'required' => true,
    'description' => 'JSON request body matching the official Plaid OpenAPI request schema for this operation.',
  ),
);
    protected const METHOD = 'post';
    protected const PATH = '/credit/asset_report/freddie_mac/get';
    protected const PATH_PARAMS = array (
);
    protected const BODY_REQUIRED = true;
}