<?php

namespace OpenCompany\Integrations\Plaid\Tools;

/**
 * Retrieve information from the bank accounts used for employment verification.
 *
 * Maps to the official Plaid endpoint post /beta/credit/v1/bank_employment/get.
 */
class PlaidCreditBankEmploymentGet extends AbstractPlaidTool
{
    protected const NAME = 'plaid_credit_bank_employment_get';
    protected const DESCRIPTION = 'Retrieve information from the bank accounts used for employment verification

Official Plaid endpoint: POST /beta/credit/v1/bank_employment/get

`/credit/bank_employment/get` returns the employment report(s) derived from bank transaction data for a specified user.';
    protected const PARAMETERS = array (
  'body' =>
  array (
    'type' => 'object',
    'required' => true,
    'description' => 'JSON request body matching the official Plaid OpenAPI request schema for this operation.',
  ),
);
    protected const METHOD = 'post';
    protected const PATH = '/beta/credit/v1/bank_employment/get';
    protected const PATH_PARAMS = array (
);
    protected const BODY_REQUIRED = true;
}