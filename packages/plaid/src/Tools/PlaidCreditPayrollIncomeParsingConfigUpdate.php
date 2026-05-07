<?php

namespace OpenCompany\Integrations\Plaid\Tools;

/**
 * Update the parsing configuration for a document income verification.
 *
 * Maps to the official Plaid endpoint post /credit/payroll_income/parsing_config/update.
 */
class PlaidCreditPayrollIncomeParsingConfigUpdate extends AbstractPlaidTool
{
    protected const NAME = 'plaid_credit_payroll_income_parsing_config_update';
    protected const DESCRIPTION = 'Update the parsing configuration for a document income verification

Official Plaid endpoint: POST /credit/payroll_income/parsing_config/update

`/credit/payroll_income/parsing_config/update` updates the parsing configuration for a document income verification.';
    protected const PARAMETERS = array (
  'body' =>
  array (
    'type' => 'object',
    'required' => true,
    'description' => 'JSON request body matching the official Plaid OpenAPI request schema for this operation.',
  ),
);
    protected const METHOD = 'post';
    protected const PATH = '/credit/payroll_income/parsing_config/update';
    protected const PATH_PARAMS = array (
);
    protected const BODY_REQUIRED = true;
}