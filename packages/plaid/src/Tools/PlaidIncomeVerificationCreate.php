<?php

namespace OpenCompany\Integrations\Plaid\Tools;

/**
 * (Deprecated) Create an income verification instance.
 *
 * Maps to the official Plaid endpoint post /income/verification/create.
 */
class PlaidIncomeVerificationCreate extends AbstractPlaidTool
{
    protected const NAME = 'plaid_income_verification_create';
    protected const DESCRIPTION = '(Deprecated) Create an income verification instance

Official Plaid endpoint: POST /income/verification/create

`/income/verification/create` begins the income verification process by returning an `income_verification_id`. You can then provide the `income_verification_id` to `/link/token/create` under the `income_verification` parameter in order to create a Link instance that will prompt the user to go through the income verification flow. Plaid will fire an `INCOME` webhook once the user completes the Payroll Income flow, or when the uploaded documents in the Document Income flow have finished processing.';
    protected const PARAMETERS = array (
  'body' =>
  array (
    'type' => 'object',
    'required' => true,
    'description' => 'JSON request body matching the official Plaid OpenAPI request schema for this operation.',
  ),
);
    protected const METHOD = 'post';
    protected const PATH = '/income/verification/create';
    protected const PATH_PARAMS = array (
);
    protected const BODY_REQUIRED = true;
}