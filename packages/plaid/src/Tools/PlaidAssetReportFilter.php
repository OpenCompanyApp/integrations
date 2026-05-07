<?php

namespace OpenCompany\Integrations\Plaid\Tools;

/**
 * Filter Asset Report.
 *
 * Maps to the official Plaid endpoint post /asset_report/filter.
 */
class PlaidAssetReportFilter extends AbstractPlaidTool
{
    protected const NAME = 'plaid_asset_report_filter';
    protected const DESCRIPTION = 'Filter Asset Report

Official Plaid endpoint: POST /asset_report/filter

By default, an Asset Report will contain all of the accounts on a given Item. In some cases, you may not want the Asset Report to contain all accounts. For example, you might have the end user choose which accounts are relevant in Link using the Account Select view, which you can enable in the dashboard. Or, you might always exclude certain account types or subtypes, which you can identify by using the `/accounts/get` endpoint. To narrow an Asset Report to only a subset of accounts, use the `/asset_report/filter` endpoint. To exclude certain Accounts from an Asset Report, first use the `/asset_report/create` endpoint to create the report, then send the `asset_report_token` along with a li...';
    protected const PARAMETERS = array (
  'body' =>
  array (
    'type' => 'object',
    'required' => true,
    'description' => 'JSON request body matching the official Plaid OpenAPI request schema for this operation.',
  ),
);
    protected const METHOD = 'post';
    protected const PATH = '/asset_report/filter';
    protected const PATH_PARAMS = array (
);
    protected const BODY_REQUIRED = true;
}