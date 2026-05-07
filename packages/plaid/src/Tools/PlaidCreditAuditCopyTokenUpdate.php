<?php

namespace OpenCompany\Integrations\Plaid\Tools;

/**
 * Update an Audit Copy Token.
 *
 * Maps to the official Plaid endpoint post /credit/audit_copy_token/update.
 */
class PlaidCreditAuditCopyTokenUpdate extends AbstractPlaidTool
{
    protected const NAME = 'plaid_credit_audit_copy_token_update';
    protected const DESCRIPTION = 'Update an Audit Copy Token

Official Plaid endpoint: POST /credit/audit_copy_token/update

The `/credit/audit_copy_token/update` endpoint updates an existing Audit Copy Token by adding the report tokens in the `report_tokens` field to the `audit_copy_token`. If the Audit Copy Token already contains a report of a certain type, it will be replaced with the token provided in the `report_tokens` field.';
    protected const PARAMETERS = array (
  'body' =>
  array (
    'type' => 'object',
    'required' => true,
    'description' => 'JSON request body matching the official Plaid OpenAPI request schema for this operation.',
  ),
);
    protected const METHOD = 'post';
    protected const PATH = '/credit/audit_copy_token/update';
    protected const PATH_PARAMS = array (
);
    protected const BODY_REQUIRED = true;
}