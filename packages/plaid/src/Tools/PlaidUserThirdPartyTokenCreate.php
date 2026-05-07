<?php

namespace OpenCompany\Integrations\Plaid\Tools;

/**
 * Create a third-party user token.
 *
 * Maps to the official Plaid endpoint post /user/third_party_token/create.
 */
class PlaidUserThirdPartyTokenCreate extends AbstractPlaidTool
{
    protected const NAME = 'plaid_user_third_party_token_create';
    protected const DESCRIPTION = 'Create a third-party user token

Official Plaid endpoint: POST /user/third_party_token/create

This endpoint is used to create a third-party user token. This token can be shared with and used by a specified third-party client to access data associated with the user through supported endpoints. Ensure you store the `third_party_user_token` along with the `user_token` and `third_party_client_id`, as it is not possible to retrieve a previously created `third_party_user_token`.';
    protected const PARAMETERS = array (
  'body' =>
  array (
    'type' => 'object',
    'required' => true,
    'description' => 'JSON request body matching the official Plaid OpenAPI request schema for this operation.',
  ),
);
    protected const METHOD = 'post';
    protected const PATH = '/user/third_party_token/create';
    protected const PATH_PARAMS = array (
);
    protected const BODY_REQUIRED = true;
}