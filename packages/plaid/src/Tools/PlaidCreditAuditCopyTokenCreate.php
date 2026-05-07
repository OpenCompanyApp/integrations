<?php

namespace OpenCompany\Integrations\Plaid\Tools;

/**
 * Create Asset or Income Report Audit Copy Token.
 *
 * Maps to the official Plaid endpoint post /credit/audit_copy_token/create.
 */
class PlaidCreditAuditCopyTokenCreate extends AbstractPlaidTool
{
    protected const NAME = 'plaid_credit_audit_copy_token_create';
    protected const DESCRIPTION = 'Create Asset or Income Report Audit Copy Token

Official Plaid endpoint: POST /credit/audit_copy_token/create

Plaid can create an Audit Copy token of an Asset Report and/or Income Report to share with a participating Government Sponsored Entity (GSE) if you participate in Fannie Mae\'s Day 1 Certainty™ program or utilize Freddie Mac\'s Loan Product Advisor® (LPA®) Asset and Income Modeler (AIM). An Audit Copy token contains the same underlying data as the Asset Report and/or Income Report (result of `/credit/payroll_income/get`). Use the `/credit/audit_copy_token/create` endpoint to create an `audit_copy_token` and then pass that token to the GSE who needs access.';
    protected const PARAMETERS = array (
  'body' =>
  array (
    'type' => 'object',
    'required' => true,
    'description' => 'JSON request body matching the official Plaid OpenAPI request schema for this operation.',
  ),
);
    protected const METHOD = 'post';
    protected const PATH = '/credit/audit_copy_token/create';
    protected const PATH_PARAMS = array (
);
    protected const BODY_REQUIRED = true;
}