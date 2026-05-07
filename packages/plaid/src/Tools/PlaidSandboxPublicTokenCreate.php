<?php

namespace OpenCompany\Integrations\Plaid\Tools;

/**
 * Create a test Item.
 *
 * Maps to the official Plaid endpoint post /sandbox/public_token/create.
 */
class PlaidSandboxPublicTokenCreate extends AbstractPlaidTool
{
    protected const NAME = 'plaid_sandbox_public_token_create';
    protected const DESCRIPTION = 'Create a test Item

Official Plaid endpoint: POST /sandbox/public_token/create

Use the `/sandbox/public_token/create` endpoint to create a valid `public_token` for an arbitrary institution ID, initial products, and test credentials. The created `public_token` maps to a new Sandbox Item. You can then call `/item/public_token/exchange` to exchange the `public_token` for an `access_token` and perform all API actions. `/sandbox/public_token/create` can also be used with the [`user_custom` test username](https://plaid.com/docs/sandbox/user-custom) to generate a test account with custom data, or with Plaid\'s [pre-populated Sandbox test accounts](https://plaid.com/docs/sandbox/test-credentials/).';
    protected const PARAMETERS = array (
  'body' =>
  array (
    'type' => 'object',
    'required' => true,
    'description' => 'JSON request body matching the official Plaid OpenAPI request schema for this operation.',
  ),
);
    protected const METHOD = 'post';
    protected const PATH = '/sandbox/public_token/create';
    protected const PATH_PARAMS = array (
);
    protected const BODY_REQUIRED = true;
}