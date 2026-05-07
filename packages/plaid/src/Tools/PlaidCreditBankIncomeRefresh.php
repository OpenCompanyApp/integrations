<?php

namespace OpenCompany\Integrations\Plaid\Tools;

/**
 * Refresh a user's bank income information.
 *
 * Maps to the official Plaid endpoint post /credit/bank_income/refresh.
 */
class PlaidCreditBankIncomeRefresh extends AbstractPlaidTool
{
    protected const NAME = 'plaid_credit_bank_income_refresh';
    protected const DESCRIPTION = 'Refresh a user\'s bank income information

Official Plaid endpoint: POST /credit/bank_income/refresh

`/credit/bank_income/refresh` is deprecated. The backend implementation was removed (returns an `Unimplemented` error at runtime), and the endpoint is no longer part of the documented API surface. To refresh Bank Income data for an existing user, send the user through Link Update Mode so they can confirm their income sources. For a fully backend refresh, migrate to CRA Income Insights and call `/cra/check_report/create`.';
    protected const PARAMETERS = array (
  'body' =>
  array (
    'type' => 'object',
    'required' => true,
    'description' => 'JSON request body matching the official Plaid OpenAPI request schema for this operation.',
  ),
);
    protected const METHOD = 'post';
    protected const PATH = '/credit/bank_income/refresh';
    protected const PATH_PARAMS = array (
);
    protected const BODY_REQUIRED = true;
}