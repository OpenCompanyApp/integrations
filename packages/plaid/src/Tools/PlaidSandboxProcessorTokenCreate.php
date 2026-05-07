<?php

namespace OpenCompany\Integrations\Plaid\Tools;

/**
 * Create a test Item and processor token.
 *
 * Maps to the official Plaid endpoint post /sandbox/processor_token/create.
 */
class PlaidSandboxProcessorTokenCreate extends AbstractPlaidTool
{
    protected const NAME = 'plaid_sandbox_processor_token_create';
    protected const DESCRIPTION = 'Create a test Item and processor token

Official Plaid endpoint: POST /sandbox/processor_token/create

Use the `/sandbox/processor_token/create` endpoint to create a valid `processor_token` for an arbitrary institution ID and test credentials. The created `processor_token` corresponds to a new Sandbox Item. You can then use this `processor_token` with the `/processor/` API endpoints in Sandbox. You can also use `/sandbox/processor_token/create` with the [`user_custom` test username](https://plaid.com/docs/sandbox/user-custom) to generate a test account with custom data.';
    protected const PARAMETERS = array (
  'body' =>
  array (
    'type' => 'object',
    'required' => true,
    'description' => 'JSON request body matching the official Plaid OpenAPI request schema for this operation.',
  ),
);
    protected const METHOD = 'post';
    protected const PATH = '/sandbox/processor_token/create';
    protected const PATH_PARAMS = array (
);
    protected const BODY_REQUIRED = true;
}