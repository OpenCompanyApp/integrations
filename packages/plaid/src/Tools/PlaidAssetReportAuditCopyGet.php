<?php

namespace OpenCompany\Integrations\Plaid\Tools;

/**
 * Retrieve an Asset Report Audit Copy.
 *
 * Maps to the official Plaid endpoint post /asset_report/audit_copy/get.
 */
class PlaidAssetReportAuditCopyGet extends AbstractPlaidTool
{
    protected const NAME = 'plaid_asset_report_audit_copy_get';
    protected const DESCRIPTION = 'Retrieve an Asset Report Audit Copy

Official Plaid endpoint: POST /asset_report/audit_copy/get

`/asset_report/audit_copy/get` allows auditors to get a copy of an Asset Report that was previously shared via the `/asset_report/audit_copy/create` endpoint. The caller of `/asset_report/audit_copy/create` must provide the `audit_copy_token` to the auditor. This token can then be used to call `/asset_report/audit_copy/get`.';
    protected const PARAMETERS = array (
  'body' =>
  array (
    'type' => 'object',
    'required' => true,
    'description' => 'JSON request body matching the official Plaid OpenAPI request schema for this operation.',
  ),
);
    protected const METHOD = 'post';
    protected const PATH = '/asset_report/audit_copy/get';
    protected const PATH_PARAMS = array (
);
    protected const BODY_REQUIRED = true;
}