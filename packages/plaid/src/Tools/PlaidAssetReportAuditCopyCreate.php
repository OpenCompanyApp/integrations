<?php

namespace OpenCompany\Integrations\Plaid\Tools;

/**
 * Create Asset Report Audit Copy.
 *
 * Maps to the official Plaid endpoint post /asset_report/audit_copy/create.
 */
class PlaidAssetReportAuditCopyCreate extends AbstractPlaidTool
{
    protected const NAME = 'plaid_asset_report_audit_copy_create';
    protected const DESCRIPTION = 'Create Asset Report Audit Copy

Official Plaid endpoint: POST /asset_report/audit_copy/create

Plaid can provide an Audit Copy of any Asset Report directly to a participating third party on your behalf. For example, Plaid can supply an Audit Copy directly to the GSEs on your behalf if you participate in Fannie Mae\'s Day 1 Certainty™ program or utilize Freddie Mac’s Loan Product Advisor® (LPA®) Asset and Income Modeler (AIM). An Audit Copy contains the same underlying data as the Asset Report. To grant access to an Audit Copy, use the `/asset_report/audit_copy/create` endpoint to create an `audit_copy_token` and then pass that token to the third party who needs access. Each third party has its own `auditor_id`, for example `fannie_mae`. You’ll need to create a separate Audit...';
    protected const PARAMETERS = array (
  'body' =>
  array (
    'type' => 'object',
    'required' => true,
    'description' => 'JSON request body matching the official Plaid OpenAPI request schema for this operation.',
  ),
);
    protected const METHOD = 'post';
    protected const PATH = '/asset_report/audit_copy/create';
    protected const PATH_PARAMS = array (
);
    protected const BODY_REQUIRED = true;
}