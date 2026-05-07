<?php

namespace OpenCompany\Integrations\Plaid\Tools;

/**
 * Create an Asset Report.
 *
 * Maps to the official Plaid endpoint post /asset_report/create.
 */
class PlaidAssetReportCreate extends AbstractPlaidTool
{
    protected const NAME = 'plaid_asset_report_create';
    protected const DESCRIPTION = 'Create an Asset Report

Official Plaid endpoint: POST /asset_report/create

The `/asset_report/create` endpoint initiates the process of creating an Asset Report, which can then be retrieved by passing the `asset_report_token` return value to the `/asset_report/get` or `/asset_report/pdf/get` endpoints. The Asset Report takes some time to be created and is not available immediately after calling `/asset_report/create`. The exact amount of time to create the report will vary depending on how many days of history are requested and will typically range from a few seconds to about one minute. When the Asset Report is ready to be retrieved using `/asset_report/get` or `/asset_report/pdf/get`, Plaid will fire a `PRODUCT_READY` webhook. For full details of the webhook s...';
    protected const PARAMETERS = array (
  'body' =>
  array (
    'type' => 'object',
    'required' => true,
    'description' => 'JSON request body matching the official Plaid OpenAPI request schema for this operation.',
  ),
);
    protected const METHOD = 'post';
    protected const PATH = '/asset_report/create';
    protected const PATH_PARAMS = array (
);
    protected const BODY_REQUIRED = true;
}