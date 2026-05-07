<?php

namespace OpenCompany\Integrations\Plaid\Tools;

/**
 * Remove an Audit Copy token.
 *
 * Maps to the official Plaid endpoint post /credit/audit_copy_token/remove.
 */
class PlaidCreditReportAuditCopyRemove extends AbstractPlaidTool
{
    protected const NAME = 'plaid_credit_report_audit_copy_remove';
    protected const DESCRIPTION = 'Remove an Audit Copy token

Official Plaid endpoint: POST /credit/audit_copy_token/remove

The `/credit/audit_copy_token/remove` endpoint allows you to remove an Audit Copy. Removing an Audit Copy invalidates the `audit_copy_token` associated with it, meaning both you and any third parties holding the token will no longer be able to use it to access Report data. Items associated with the Report data and other Audit Copies of it are not affected and will remain accessible after removing the given Audit Copy.';
    protected const PARAMETERS = array (
  'body' =>
  array (
    'type' => 'object',
    'required' => true,
    'description' => 'JSON request body matching the official Plaid OpenAPI request schema for this operation.',
  ),
);
    protected const METHOD = 'post';
    protected const PATH = '/credit/audit_copy_token/remove';
    protected const PATH_PARAMS = array (
);
    protected const BODY_REQUIRED = true;
}