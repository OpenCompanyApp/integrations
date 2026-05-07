<?php

namespace OpenCompany\Integrations\Plaid\Tools;

/**
 * Create a bank transfer as a processor.
 *
 * Maps to the official Plaid endpoint post /processor/bank_transfer/create.
 */
class PlaidProcessorBankTransferCreate extends AbstractPlaidTool
{
    protected const NAME = 'plaid_processor_bank_transfer_create';
    protected const DESCRIPTION = 'Create a bank transfer as a processor

Official Plaid endpoint: POST /processor/bank_transfer/create

Use the `/processor/bank_transfer/create` endpoint to initiate a new bank transfer as a processor';
    protected const PARAMETERS = array (
  'body' =>
  array (
    'type' => 'object',
    'required' => true,
    'description' => 'JSON request body matching the official Plaid OpenAPI request schema for this operation.',
  ),
);
    protected const METHOD = 'post';
    protected const PATH = '/processor/bank_transfer/create';
    protected const PATH_PARAMS = array (
);
    protected const BODY_REQUIRED = true;
}