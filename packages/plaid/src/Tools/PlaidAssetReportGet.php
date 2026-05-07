<?php

namespace OpenCompany\Integrations\Plaid\Tools;

/**
 * Retrieve an Asset Report.
 *
 * Maps to the official Plaid endpoint post /asset_report/get.
 */
class PlaidAssetReportGet extends AbstractPlaidTool
{
    protected const NAME = 'plaid_asset_report_get';
    protected const DESCRIPTION = 'Retrieve an Asset Report

Official Plaid endpoint: POST /asset_report/get

The `/asset_report/get` endpoint retrieves the Asset Report in JSON format. Before calling `/asset_report/get`, you must first create the Asset Report using `/asset_report/create` (or filter an Asset Report using `/asset_report/filter`) and then wait for the [`PRODUCT_READY`](https://plaid.com/docs/api/products/assets/#product_ready) webhook to fire, indicating that the Report is ready to be retrieved. By default, an Asset Report includes transaction descriptions as returned by the bank, as opposed to parsed and categorized by Plaid. You can also receive cleaned and categorized transactions, as well as additional insights like merchant name or location information. We call this an Asset R...';
    protected const PARAMETERS = array (
  'body' =>
  array (
    'type' => 'object',
    'required' => true,
    'description' => 'JSON request body matching the official Plaid OpenAPI request schema for this operation.',
  ),
);
    protected const METHOD = 'post';
    protected const PATH = '/asset_report/get';
    protected const PATH_PARAMS = array (
);
    protected const BODY_REQUIRED = true;
}