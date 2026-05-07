<?php

namespace OpenCompany\Integrations\Plaid\Tools;

/**
 * Retrieve information from the bank accounts used for income verification.
 *
 * Maps to the official Plaid endpoint post /credit/bank_income/get.
 */
class PlaidCreditBankIncomeGet extends AbstractPlaidTool
{
    protected const NAME = 'plaid_credit_bank_income_get';
    protected const DESCRIPTION = 'Retrieve information from the bank accounts used for income verification

Official Plaid endpoint: POST /credit/bank_income/get

`/credit/bank_income/get` returns the bank income report(s) for a specified user. A single report corresponds to all institutions linked in a single Link session. To include multiple institutions in a single report, use [Multi-Item Link](https://plaid.com/docs/link/multi-item-link). To return older reports, use the `options.count` field.';
    protected const PARAMETERS = array (
  'body' =>
  array (
    'type' => 'object',
    'required' => true,
    'description' => 'JSON request body matching the official Plaid OpenAPI request schema for this operation.',
  ),
);
    protected const METHOD = 'post';
    protected const PATH = '/credit/bank_income/get';
    protected const PATH_PARAMS = array (
);
    protected const BODY_REQUIRED = true;
}