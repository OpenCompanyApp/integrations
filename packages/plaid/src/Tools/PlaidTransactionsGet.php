<?php

namespace OpenCompany\Integrations\Plaid\Tools;

/**
 * Get transaction data.
 *
 * Maps to the official Plaid endpoint post /transactions/get.
 */
class PlaidTransactionsGet extends AbstractPlaidTool
{
    protected const NAME = 'plaid_transactions_get';
    protected const DESCRIPTION = 'Get transaction data

Official Plaid endpoint: POST /transactions/get

Note: All new implementations are encouraged to use `/transactions/sync` rather than `/transactions/get`. `/transactions/sync` provides the same functionality as `/transactions/get` and improves developer ease-of-use for handling transactions updates. The `/transactions/get` endpoint allows developers to receive user-authorized transaction data for credit, depository, and some loan-type accounts (only those with account subtype `student`; coverage may be limited). For transaction history from investments accounts, use the [Investments endpoint](https://plaid.com/docs/api/products/investments/) instead. Transaction data is standardized across financial institutions, and in many cases trans...';
    protected const PARAMETERS = array (
  'body' =>
  array (
    'type' => 'object',
    'required' => true,
    'description' => 'JSON request body matching the official Plaid OpenAPI request schema for this operation.',
  ),
);
    protected const METHOD = 'post';
    protected const PATH = '/transactions/get';
    protected const PATH_PARAMS = array (
);
    protected const BODY_REQUIRED = true;
}