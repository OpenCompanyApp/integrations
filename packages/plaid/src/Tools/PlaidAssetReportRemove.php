<?php

namespace OpenCompany\Integrations\Plaid\Tools;

/**
 * Delete an Asset Report.
 *
 * Maps to the official Plaid endpoint post /asset_report/remove.
 */
class PlaidAssetReportRemove extends AbstractPlaidTool
{
    protected const NAME = 'plaid_asset_report_remove';
    protected const DESCRIPTION = 'Delete an Asset Report

Official Plaid endpoint: POST /asset_report/remove

The `/item/remove` endpoint allows you to invalidate an `access_token`, meaning you will not be able to create new Asset Reports with it. Removing an Item does not affect any Asset Reports or Audit Copies you have already created, which will remain accessible until you remove them specifically. The `/asset_report/remove` endpoint allows you to remove access to an Asset Report. Removing an Asset Report invalidates its `asset_report_token`, meaning you will no longer be able to use it to access Report data or create new Audit Copies. Removing an Asset Report does not affect the underlying Items, but does invalidate any `audit_copy_tokens` associated with the Asset Report.';
    protected const PARAMETERS = array (
  'body' =>
  array (
    'type' => 'object',
    'required' => true,
    'description' => 'JSON request body matching the official Plaid OpenAPI request schema for this operation.',
  ),
);
    protected const METHOD = 'post';
    protected const PATH = '/asset_report/remove';
    protected const PATH_PARAMS = array (
);
    protected const BODY_REQUIRED = true;
}