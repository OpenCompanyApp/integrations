<?php

namespace OpenCompany\Integrations\Plaid\Tools;

/**
 * Check income verification eligibility and optimize conversion.
 *
 * Maps to the official Plaid endpoint post /credit/payroll_income/precheck.
 */
class PlaidCreditPayrollIncomePrecheck extends AbstractPlaidTool
{
    protected const NAME = 'plaid_credit_payroll_income_precheck';
    protected const DESCRIPTION = 'Check income verification eligibility and optimize conversion

Official Plaid endpoint: POST /credit/payroll_income/precheck

`/credit/payroll_income/precheck` is an optional endpoint that can be called before initializing a Link session for income verification. It evaluates whether a given user is supportable by digital income verification. If the user is eligible for digital verification, that information will be associated with the user token, and in this way will generate a Link UI optimized for the end user and their specific employer. If the user cannot be confirmed as eligible, the user can still use the income verification flow, but they may be required to manually upload a paystub to verify their income. While all request fields are optional, providing `employer` data will increase the chance of receivi...';
    protected const PARAMETERS = array (
  'body' =>
  array (
    'type' => 'object',
    'required' => true,
    'description' => 'JSON request body matching the official Plaid OpenAPI request schema for this operation.',
  ),
);
    protected const METHOD = 'post';
    protected const PATH = '/credit/payroll_income/precheck';
    protected const PATH_PARAMS = array (
);
    protected const BODY_REQUIRED = true;
}