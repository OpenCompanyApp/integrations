<?php

namespace OpenCompany\Integrations\Plaid\Tools;

/**
 * Create user.
 *
 * Maps to the official Plaid endpoint post /user/create.
 */
class PlaidUserCreate extends AbstractPlaidTool
{
    protected const NAME = 'plaid_user_create';
    protected const DESCRIPTION = 'Create user

Official Plaid endpoint: POST /user/create

For Plaid products and flows that use the user object, `/user/create` provides you a single token to access all data associated with the user. You must call this endpoint before calling `/link/token/create` if you are using any of the following: Plaid Check, Income Verification, Multi-Item Link, or Plaid Protect (Identity). If you are using Plaid Protect Link session scoring, you do not need to call `/user/create` first; Plaid will resolve or create the user when `user.client_user_id` is provided in `/link/token/create`. For customers who began using this endpoint on or after December 10, 2025, this endpoint takes a `client_user_id` and an `identity` object and will return a `user_id`. Fo...';
    protected const PARAMETERS = array (
  'body' =>
  array (
    'type' => 'object',
    'required' => true,
    'description' => 'JSON request body matching the official Plaid OpenAPI request schema for this operation.',
  ),
);
    protected const METHOD = 'post';
    protected const PATH = '/user/create';
    protected const PATH_PARAMS = array (
);
    protected const BODY_REQUIRED = true;
}