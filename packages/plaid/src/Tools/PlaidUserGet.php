<?php

namespace OpenCompany\Integrations\Plaid\Tools;

/**
 * Retrieve user identity and information.
 *
 * Maps to the official Plaid endpoint post /user/get.
 */
class PlaidUserGet extends AbstractPlaidTool
{
    protected const NAME = 'plaid_user_get';
    protected const DESCRIPTION = 'Retrieve user identity and information

Official Plaid endpoint: POST /user/get

Get user details using a `user_id`. This endpoint only supports users that were created on the new user API flow, without a `user_token`. For more details, see [New User APIs](https://plaid.com/docs/api/users/user-apis).';
    protected const PARAMETERS = array (
  'body' =>
  array (
    'type' => 'object',
    'required' => true,
    'description' => 'JSON request body matching the official Plaid OpenAPI request schema for this operation.',
  ),
);
    protected const METHOD = 'post';
    protected const PATH = '/user/get';
    protected const PATH_PARAMS = array (
);
    protected const BODY_REQUIRED = true;
}