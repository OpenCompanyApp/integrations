<?php

namespace OpenCompany\Integrations\Plaid\Tools;

/**
 * Refresh an Asset Report.
 *
 * Maps to the official Plaid endpoint post /asset_report/refresh.
 */
class PlaidAssetReportRefresh extends AbstractPlaidTool
{
    protected const NAME = 'plaid_asset_report_refresh';
    protected const DESCRIPTION = 'Refresh an Asset Report

Official Plaid endpoint: POST /asset_report/refresh

An Asset Report is an immutable snapshot of a user\'s assets. In order to "refresh" an Asset Report you created previously, you can use the `/asset_report/refresh` endpoint to create a new Asset Report based on the old one, but with the most recent data available. The new Asset Report will contain the same Items as the original Report, as well as the same filters applied by any call to `/asset_report/filter`. By default, the new Asset Report will also use the same parameters you submitted with your original `/asset_report/create` request, but the original `days_requested` value and the values of any parameters in the `options` object can be overridden with new values. To change these argum...';
    protected const PARAMETERS = array (
  'body' =>
  array (
    'type' => 'object',
    'required' => true,
    'description' => 'JSON request body matching the official Plaid OpenAPI request schema for this operation.',
  ),
);
    protected const METHOD = 'post';
    protected const PATH = '/asset_report/refresh';
    protected const PATH_PARAMS = array (
);
    protected const BODY_REQUIRED = true;
}