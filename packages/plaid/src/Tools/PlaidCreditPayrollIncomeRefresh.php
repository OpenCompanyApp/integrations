<?php

namespace OpenCompany\Integrations\Plaid\Tools;

/**
 * Refresh a digital payroll income verification.
 *
 * Maps to the official Plaid endpoint post /credit/payroll_income/refresh.
 */
class PlaidCreditPayrollIncomeRefresh extends AbstractPlaidTool
{
    protected const NAME = 'plaid_credit_payroll_income_refresh';
    protected const DESCRIPTION = 'Refresh a digital payroll income verification

Official Plaid endpoint: POST /credit/payroll_income/refresh

`/credit/payroll_income/refresh` refreshes a given digital payroll income verification.';
    protected const PARAMETERS = array (
  'body' =>
  array (
    'type' => 'object',
    'required' => true,
    'description' => 'JSON request body matching the official Plaid OpenAPI request schema for this operation.',
  ),
);
    protected const METHOD = 'post';
    protected const PATH = '/credit/payroll_income/refresh';
    protected const PATH_PARAMS = array (
);
    protected const BODY_REQUIRED = true;
}