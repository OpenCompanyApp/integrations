<?php

namespace OpenCompany\Integrations\Plaid\Tools;

/**
 * Create a Link token for Layer.
 *
 * Maps to the official Plaid endpoint post /session/token/create.
 */
class PlaidSessionTokenCreate extends AbstractPlaidTool
{
    protected const NAME = 'plaid_session_token_create';
    protected const DESCRIPTION = 'Create a Link token for Layer

Official Plaid endpoint: POST /session/token/create

`/session/token/create` is used to create a Link token for Layer. The returned Link token is used as an parameter when initializing the Link SDK. For more details, see the [Link flow overview](https://plaid.com/docs/link/#link-flow-overview).';
    protected const PARAMETERS = array (
  'body' =>
  array (
    'type' => 'object',
    'required' => true,
    'description' => 'JSON request body matching the official Plaid OpenAPI request schema for this operation.',
  ),
);
    protected const METHOD = 'post';
    protected const PATH = '/session/token/create';
    protected const PATH_PARAMS = array (
);
    protected const BODY_REQUIRED = true;
}