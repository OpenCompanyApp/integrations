<?php

namespace OpenCompany\Integrations\Plaid\Tools;

/**
 * Retrieve Liabilities data.
 *
 * Maps to the official Plaid endpoint post /liabilities/get.
 */
class PlaidLiabilitiesGet extends AbstractPlaidTool
{
    protected const NAME = 'plaid_liabilities_get';
    protected const DESCRIPTION = 'Retrieve Liabilities data

Official Plaid endpoint: POST /liabilities/get

The `/liabilities/get` endpoint returns various details about an Item with loan or credit accounts. Liabilities data is available primarily for US financial institutions, with some limited coverage of Canadian institutions. Currently supported account types are account type `credit` with account subtype `credit card` or `paypal`, and account type `loan` with account subtype `student` or `mortgage`. To limit accounts listed in Link to types and subtypes supported by Liabilities, you can use the `account_filters` parameter when [creating a Link token](https://plaid.com/docs/api/link/#linktokencreate). The types of information returned by Liabilities can include balances and due dates, loan ...';
    protected const PARAMETERS = array (
  'body' =>
  array (
    'type' => 'object',
    'required' => true,
    'description' => 'JSON request body matching the official Plaid OpenAPI request schema for this operation.',
  ),
);
    protected const METHOD = 'post';
    protected const PATH = '/liabilities/get';
    protected const PATH_PARAMS = array (
);
    protected const BODY_REQUIRED = true;
}