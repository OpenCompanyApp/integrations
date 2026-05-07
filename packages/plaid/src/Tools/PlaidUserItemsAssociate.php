<?php

namespace OpenCompany\Integrations\Plaid\Tools;

/**
 * Associate Items to a User.
 *
 * Maps to the official Plaid endpoint post /user/items/associate.
 */
class PlaidUserItemsAssociate extends AbstractPlaidTool
{
    protected const NAME = 'plaid_user_items_associate';
    protected const DESCRIPTION = 'Associate Items to a User

Official Plaid endpoint: POST /user/items/associate

Associates Items to the target user. If an Item is already associated to another user, the Item will be disassociated with the existing user and associated to the target user. This operation supports a max of 100 Items.';
    protected const PARAMETERS = array (
  'body' =>
  array (
    'type' => 'object',
    'required' => true,
    'description' => 'JSON request body matching the official Plaid OpenAPI request schema for this operation.',
  ),
);
    protected const METHOD = 'post';
    protected const PATH = '/user/items/associate';
    protected const PATH_PARAMS = array (
);
    protected const BODY_REQUIRED = true;
}