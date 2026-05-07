<?php

namespace OpenCompany\Integrations\Plaid\Tools;

/**
 * Get Items associated with a User.
 *
 * Maps to the official Plaid endpoint post /user/items/get.
 */
class PlaidUserItemsGet extends AbstractPlaidTool
{
    protected const NAME = 'plaid_user_items_get';
    protected const DESCRIPTION = 'Get Items associated with a User

Official Plaid endpoint: POST /user/items/get

Returns Items associated with a `user_id`, along with their corresponding statuses. Plaid associates an Item with a User when it has been successfully connected within a Link session initialized with that `user_id`.';
    protected const PARAMETERS = array (
  'body' =>
  array (
    'type' => 'object',
    'required' => true,
    'description' => 'JSON request body matching the official Plaid OpenAPI request schema for this operation.',
  ),
);
    protected const METHOD = 'post';
    protected const PATH = '/user/items/get';
    protected const PATH_PARAMS = array (
);
    protected const BODY_REQUIRED = true;
}