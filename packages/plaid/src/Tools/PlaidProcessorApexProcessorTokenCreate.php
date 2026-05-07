<?php

namespace OpenCompany\Integrations\Plaid\Tools;

/**
 * Create Apex bank account token.
 *
 * Maps to the official Plaid endpoint post /processor/apex/processor_token/create.
 */
class PlaidProcessorApexProcessorTokenCreate extends AbstractPlaidTool
{
    protected const NAME = 'plaid_processor_apex_processor_token_create';
    protected const DESCRIPTION = 'Create Apex bank account token

Official Plaid endpoint: POST /processor/apex/processor_token/create

Used to create a token suitable for sending to Apex to enable Plaid-Apex integrations.';
    protected const PARAMETERS = array (
  'body' =>
  array (
    'type' => 'object',
    'required' => true,
    'description' => 'JSON request body matching the official Plaid OpenAPI request schema for this operation.',
  ),
);
    protected const METHOD = 'post';
    protected const PATH = '/processor/apex/processor_token/create';
    protected const PATH_PARAMS = array (
);
    protected const BODY_REQUIRED = true;
}