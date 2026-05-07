<?php

namespace OpenCompany\Integrations\Plaid\Tools;

/**
 * Get investment transactions data.
 *
 * Maps to the official Plaid endpoint post /processor/investments/transactions/get.
 */
class PlaidProcessorInvestmentsTransactionsGet extends AbstractPlaidTool
{
    protected const NAME = 'plaid_processor_investments_transactions_get';
    protected const DESCRIPTION = 'Get investment transactions data

Official Plaid endpoint: POST /processor/investments/transactions/get

The `/processor/investments/transactions/get` endpoint allows developers to retrieve up to 24 months of user-authorized transaction data for the investment account associated with the processor token. Transactions are returned in reverse-chronological order, and the sequence of transaction ordering is stable and will not shift. Due to the potentially large number of investment transactions associated with the account, results are paginated. Manipulate the count and offset parameters in conjunction with the `total_investment_transactions` response body field to fetch all available investment transactions. Note that Investments does not have a webhook to indicate when initial transaction da...';
    protected const PARAMETERS = array (
  'body' =>
  array (
    'type' => 'object',
    'required' => true,
    'description' => 'JSON request body matching the official Plaid OpenAPI request schema for this operation.',
  ),
);
    protected const METHOD = 'post';
    protected const PATH = '/processor/investments/transactions/get';
    protected const PATH_PARAMS = array (
);
    protected const BODY_REQUIRED = true;
}