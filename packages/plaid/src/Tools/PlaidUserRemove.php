<?php

namespace OpenCompany\Integrations\Plaid\Tools;

/**
 * Remove user.
 *
 * Maps to the official Plaid endpoint post /user/remove.
 */
class PlaidUserRemove extends AbstractPlaidTool
{
    protected const NAME = 'plaid_user_remove';
    protected const DESCRIPTION = 'Remove user

Official Plaid endpoint: POST /user/remove

`/user/remove` deletes a `user_id` or `user_token` and and associated information, including any Items associated with the user.';
    protected const PARAMETERS = array (
  'body' =>
  array (
    'type' => 'object',
    'required' => true,
    'description' => 'JSON request body matching the official Plaid OpenAPI request schema for this operation.',
  ),
);
    protected const METHOD = 'post';
    protected const PATH = '/user/remove';
    protected const PATH_PARAMS = array (
);
    protected const BODY_REQUIRED = true;
}