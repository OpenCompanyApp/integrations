<?php

namespace OpenCompany\Integrations\Plaid\Tools;

/**
 * Retrieve Liabilities data.
 *
 * Maps to the official Plaid endpoint post /processor/liabilities/get.
 */
class PlaidProcessorLiabilitiesGet extends AbstractPlaidTool
{
    protected const NAME = 'plaid_processor_liabilities_get';
    protected const DESCRIPTION = 'Retrieve Liabilities data

Official Plaid endpoint: POST /processor/liabilities/get

The `/processor/liabilities/get` endpoint returns various details about a loan or credit account. Liabilities data is available primarily for US financial institutions, with some limited coverage of Canadian institutions. Currently supported account types are account type `credit` with account subtype `credit card` or `paypal`, and account type `loan` with account subtype `student` or `mortgage`. The types of information returned by Liabilities can include balances and due dates, loan terms, and account details such as original loan amount and guarantor. Data is refreshed approximately once per day; the latest data can be retrieved by calling `/processor/liabilities/get`. Note: This reque...';
    protected const PARAMETERS = array (
  'body' =>
  array (
    'type' => 'object',
    'required' => true,
    'description' => 'JSON request body matching the official Plaid OpenAPI request schema for this operation.',
  ),
);
    protected const METHOD = 'post';
    protected const PATH = '/processor/liabilities/get';
    protected const PATH_PARAMS = array (
);
    protected const BODY_REQUIRED = true;
}