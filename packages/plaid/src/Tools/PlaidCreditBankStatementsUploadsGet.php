<?php

namespace OpenCompany\Integrations\Plaid\Tools;

/**
 * Retrieve data for a user's uploaded bank statements.
 *
 * Maps to the official Plaid endpoint post /credit/bank_statements/uploads/get.
 */
class PlaidCreditBankStatementsUploadsGet extends AbstractPlaidTool
{
    protected const NAME = 'plaid_credit_bank_statements_uploads_get';
    protected const DESCRIPTION = 'Retrieve data for a user\'s uploaded bank statements

Official Plaid endpoint: POST /credit/bank_statements/uploads/get

`/credit/bank_statements/uploads/get` returns parsed data from bank statements uploaded by users as part of the Document Income flow. If your account is not enabled for Document Parsing, contact your account manager to request access.';
    protected const PARAMETERS = array (
  'body' =>
  array (
    'type' => 'object',
    'required' => true,
    'description' => 'JSON request body matching the official Plaid OpenAPI request schema for this operation.',
  ),
);
    protected const METHOD = 'post';
    protected const PATH = '/credit/bank_statements/uploads/get';
    protected const PATH_PARAMS = array (
);
    protected const BODY_REQUIRED = true;
}