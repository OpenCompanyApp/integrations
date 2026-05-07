<?php

namespace OpenCompany\Integrations\Plaid\Tools;

/**
 * Remove a third-party user token.
 *
 * Maps to the official Plaid endpoint post /user/third_party_token/remove.
 */
class PlaidUserThirdPartyTokenRemove extends AbstractPlaidTool
{
    protected const NAME = 'plaid_user_third_party_token_remove';
    protected const DESCRIPTION = 'Remove a third-party user token

Official Plaid endpoint: POST /user/third_party_token/remove

This endpoint is used to delete a third-party user token. Once removed, the token can longer be used to access data associated with the user. Any subsequent calls to retrieve information using the same third-party user token will result in an error stating the third-party user token does not exist.';
    protected const PARAMETERS = array (
  'body' =>
  array (
    'type' => 'object',
    'required' => true,
    'description' => 'JSON request body matching the official Plaid OpenAPI request schema for this operation.',
  ),
);
    protected const METHOD = 'post';
    protected const PATH = '/user/third_party_token/remove';
    protected const PATH_PARAMS = array (
);
    protected const BODY_REQUIRED = true;
}