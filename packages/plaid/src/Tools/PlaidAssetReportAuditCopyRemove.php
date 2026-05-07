<?php

namespace OpenCompany\Integrations\Plaid\Tools;

/**
 * Remove Asset Report Audit Copy.
 *
 * Maps to the official Plaid endpoint post /asset_report/audit_copy/remove.
 */
class PlaidAssetReportAuditCopyRemove extends AbstractPlaidTool
{
    protected const NAME = 'plaid_asset_report_audit_copy_remove';
    protected const DESCRIPTION = 'Remove Asset Report Audit Copy

Official Plaid endpoint: POST /asset_report/audit_copy/remove

The `/asset_report/audit_copy/remove` endpoint allows you to remove an Audit Copy. Removing an Audit Copy invalidates the `audit_copy_token` associated with it, meaning both you and any third parties holding the token will no longer be able to use it to access Report data. Items associated with the Asset Report, the Asset Report itself and other Audit Copies of it are not affected and will remain accessible after removing the given Audit Copy.';
    protected const PARAMETERS = array (
  'body' =>
  array (
    'type' => 'object',
    'required' => true,
    'description' => 'JSON request body matching the official Plaid OpenAPI request schema for this operation.',
  ),
);
    protected const METHOD = 'post';
    protected const PATH = '/asset_report/audit_copy/remove';
    protected const PATH_PARAMS = array (
);
    protected const BODY_REQUIRED = true;
}