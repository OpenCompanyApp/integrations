<?php

namespace OpenCompany\Integrations\Plaid\Tools;

/**
 * Get transaction data.
 *
 * Maps to the official Plaid endpoint post /processor/transactions/get.
 */
class PlaidProcessorTransactionsGet extends AbstractPlaidTool
{
    protected const NAME = 'plaid_processor_transactions_get';
    protected const DESCRIPTION = 'Get transaction data

Official Plaid endpoint: POST /processor/transactions/get

The `/processor/transactions/get` endpoint allows developers to receive user-authorized transaction data for credit, depository, and some loan-type accounts (only those with account subtype `student`; coverage may be limited). Transaction data is standardized across financial institutions, and in many cases transactions are linked to a clean name, entity type, location, and category. Similarly, account data is standardized and returned with a clean name, number, balance, and other meta information where available. Transactions are returned in reverse-chronological order, and the sequence of transaction ordering is stable and will not shift. Transactions are not immutable and can also be r...';
    protected const PARAMETERS = array (
  'body' =>
  array (
    'type' => 'object',
    'required' => true,
    'description' => 'JSON request body matching the official Plaid OpenAPI request schema for this operation.',
  ),
);
    protected const METHOD = 'post';
    protected const PATH = '/processor/transactions/get';
    protected const PATH_PARAMS = array (
);
    protected const BODY_REQUIRED = true;
}