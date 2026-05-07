<?php

namespace OpenCompany\Integrations\Plaid\Tools;

/**
 * enhance locally-held transaction data.
 *
 * Maps to the official Plaid endpoint post /beta/transactions/v1/enhance.
 */
class PlaidTransactionsEnhance extends AbstractPlaidTool
{
    protected const NAME = 'plaid_transactions_enhance';
    protected const DESCRIPTION = 'enhance locally-held transaction data

Official Plaid endpoint: POST /beta/transactions/v1/enhance

The `/beta/transactions/v1/enhance` endpoint enriches raw transaction data provided directly by clients. The product is currently in beta.';
    protected const PARAMETERS = array (
  'body' =>
  array (
    'type' => 'object',
    'required' => true,
    'description' => 'JSON request body matching the official Plaid OpenAPI request schema for this operation.',
  ),
);
    protected const METHOD = 'post';
    protected const PATH = '/beta/transactions/v1/enhance';
    protected const PATH_PARAMS = array (
);
    protected const BODY_REQUIRED = true;
}