<?php

namespace OpenCompany\Integrations\Plaid\Tools;

/**
 * Retrieve a user's payroll information.
 *
 * Maps to the official Plaid endpoint post /credit/payroll_income/get.
 */
class PlaidCreditPayrollIncomeGet extends AbstractPlaidTool
{
    protected const NAME = 'plaid_credit_payroll_income_get';
    protected const DESCRIPTION = 'Retrieve a user\'s payroll information

Official Plaid endpoint: POST /credit/payroll_income/get

This endpoint gets payroll income information for a specific user, either as a result of the user connecting to their payroll provider or uploading a pay related document.';
    protected const PARAMETERS = array (
  'body' =>
  array (
    'type' => 'object',
    'required' => true,
    'description' => 'JSON request body matching the official Plaid OpenAPI request schema for this operation.',
  ),
);
    protected const METHOD = 'post';
    protected const PATH = '/credit/payroll_income/get';
    protected const PATH_PARAMS = array (
);
    protected const BODY_REQUIRED = true;
}