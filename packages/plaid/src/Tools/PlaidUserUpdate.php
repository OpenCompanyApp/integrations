<?php

namespace OpenCompany\Integrations\Plaid\Tools;

/**
 * Update user information.
 *
 * Maps to the official Plaid endpoint post /user/update.
 */
class PlaidUserUpdate extends AbstractPlaidTool
{
    protected const NAME = 'plaid_user_update';
    protected const DESCRIPTION = 'Update user information

Official Plaid endpoint: POST /user/update

This endpoint updates user information for an existing `user_id` or `user_token`. If an existing `user_id` or `user_token` is missing fields required for a given use case (e.g. creating a Consumer Report) use `/user/update` to add values for those fields. Identity updates use merge semantics: provided fields overwrite existing ones; omitted fields remain unchanged.';
    protected const PARAMETERS = array (
  'body' =>
  array (
    'type' => 'object',
    'required' => true,
    'description' => 'JSON request body matching the official Plaid OpenAPI request schema for this operation.',
  ),
);
    protected const METHOD = 'post';
    protected const PATH = '/user/update';
    protected const PATH_PARAMS = array (
);
    protected const BODY_REQUIRED = true;
}