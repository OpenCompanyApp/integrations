<?php

namespace OpenCompany\Integrations\Plaid\Tools;

/**
 * Retrieve fraud insights for a user's manually uploaded document(s)..
 *
 * Maps to the official Plaid endpoint post /credit/payroll_income/risk_signals/get.
 */
class PlaidCreditPayrollIncomeRiskSignalsGet extends AbstractPlaidTool
{
    protected const NAME = 'plaid_credit_payroll_income_risk_signals_get';
    protected const DESCRIPTION = 'Retrieve fraud insights for a user\'s manually uploaded document(s).

Official Plaid endpoint: POST /credit/payroll_income/risk_signals/get

`/credit/payroll_income/risk_signals/get` can be used as part of the Document Income flow to assess a user-uploaded document for signs of potential fraud or tampering. It returns a risk score for each uploaded document that indicates the likelihood of the document being fraudulent, in addition to details on the individual risk signals contributing to the score. To trigger risk signal generation for an Item, call `/link/token/create` with `parsing_config` set to include `risk_signals`, or call `/credit/payroll_income/parsing_config/update`. Once risk signal generation has been triggered, `/credit/payroll_income/risk_signals/get` can be called at any time after the `INCOME_VERIFICATION_RISK...';
    protected const PARAMETERS = array (
  'body' =>
  array (
    'type' => 'object',
    'required' => true,
    'description' => 'JSON request body matching the official Plaid OpenAPI request schema for this operation.',
  ),
);
    protected const METHOD = 'post';
    protected const PATH = '/credit/payroll_income/risk_signals/get';
    protected const PATH_PARAMS = array (
);
    protected const BODY_REQUIRED = true;
}