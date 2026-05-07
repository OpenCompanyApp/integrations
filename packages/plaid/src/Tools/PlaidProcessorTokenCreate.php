<?php

namespace OpenCompany\Integrations\Plaid\Tools;

/**
 * Create processor token.
 *
 * Maps to the official Plaid endpoint post /processor/token/create.
 */
class PlaidProcessorTokenCreate extends AbstractPlaidTool
{
    protected const NAME = 'plaid_processor_token_create';
    protected const DESCRIPTION = 'Create processor token

Official Plaid endpoint: POST /processor/token/create

Used to create a token suitable for sending to one of Plaid\'s partners to enable integrations. Note that Stripe partnerships use bank account tokens instead; see `/processor/stripe/bank_account_token/create` for creating tokens for use with Stripe integrations. If using multiple processors, multiple different processor tokens can be created for a single access token. Once created, a processor token for a given Item can be modified by calling `/processor/token/permissions/set`. To revoke the processor\'s access, the entire Item must be deleted by calling `/item/remove`.';
    protected const PARAMETERS = array (
  'body' =>
  array (
    'type' => 'object',
    'required' => true,
    'description' => 'JSON request body matching the official Plaid OpenAPI request schema for this operation.',
  ),
);
    protected const METHOD = 'post';
    protected const PATH = '/processor/token/create';
    protected const PATH_PARAMS = array (
);
    protected const BODY_REQUIRED = true;
}