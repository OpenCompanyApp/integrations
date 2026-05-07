<?php

namespace OpenCompany\Integrations\Plaid\Tools;

/**
 * (Deprecated) Retrieve information from the paystubs used for income verification.
 *
 * Maps to the official Plaid endpoint post /income/verification/paystubs/get.
 */
class PlaidIncomeVerificationPaystubsGet extends AbstractPlaidTool
{
    protected const NAME = 'plaid_income_verification_paystubs_get';
    protected const DESCRIPTION = '(Deprecated) Retrieve information from the paystubs used for income verification

Official Plaid endpoint: POST /income/verification/paystubs/get

`/income/verification/paystubs/get` returns the information collected from the paystubs that were used to verify an end user\'s income. It can be called once the status of the verification has been set to `VERIFICATION_STATUS_PROCESSING_COMPLETE`, as reported by the `INCOME: verification_status` webhook. Attempting to call the endpoint before verification has been completed will result in an error. This endpoint has been deprecated; new integrations should use `/credit/payroll_income/get` instead.';
    protected const PARAMETERS = array (
  'body' =>
  array (
    'type' => 'object',
    'required' => true,
    'description' => 'JSON request body matching the official Plaid OpenAPI request schema for this operation.',
  ),
);
    protected const METHOD = 'post';
    protected const PATH = '/income/verification/paystubs/get';
    protected const PATH_PARAMS = array (
);
    protected const BODY_REQUIRED = true;
}