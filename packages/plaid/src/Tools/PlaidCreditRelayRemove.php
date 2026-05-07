<?php

namespace OpenCompany\Integrations\Plaid\Tools;

/**
 * Remove relay token.
 *
 * Maps to the official Plaid endpoint post /credit/relay/remove.
 */
class PlaidCreditRelayRemove extends AbstractPlaidTool
{
    protected const NAME = 'plaid_credit_relay_remove';
    protected const DESCRIPTION = 'Remove relay token

Official Plaid endpoint: POST /credit/relay/remove

The `/credit/relay/remove` endpoint allows you to invalidate a `relay_token`. The third party holding the token will no longer be able to access or refresh the reports which the `relay_token` gives access to. The original report, associated Items, and other relay tokens that provide access to the same report are not affected and will remain accessible after removing the given `relay_token`.';
    protected const PARAMETERS = array (
  'body' =>
  array (
    'type' => 'object',
    'required' => true,
    'description' => 'JSON request body matching the official Plaid OpenAPI request schema for this operation.',
  ),
);
    protected const METHOD = 'post';
    protected const PATH = '/credit/relay/remove';
    protected const PATH_PARAMS = array (
);
    protected const BODY_REQUIRED = true;
}