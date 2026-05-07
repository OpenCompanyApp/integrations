<?php

namespace OpenCompany\Integrations\Plaid\Tools;

/**
 * Remove Items from a User.
 *
 * Maps to the official Plaid endpoint post /user/items/remove.
 */
class PlaidUserItemsRemove extends AbstractPlaidTool
{
    protected const NAME = 'plaid_user_items_remove';
    protected const DESCRIPTION = 'Remove Items from a User

Official Plaid endpoint: POST /user/items/remove

Removes specific Items associated with a user. It is equivalent to calling `/item/remove` on each Item individually, but supports use cases (such as Plaid Check) where access tokens are not available. All specified Items must belong to the user or the entire operation fails. Similar to `/item/remove`, this deletes Item product data, terminates billing on the Item\'s products, and fires webhooks to the financial institution. Once removed, Items cannot be reconnected without going through Link again.';
    protected const PARAMETERS = array (
  'body' =>
  array (
    'type' => 'object',
    'required' => true,
    'description' => 'JSON request body matching the official Plaid OpenAPI request schema for this operation.',
  ),
);
    protected const METHOD = 'post';
    protected const PATH = '/user/items/remove';
    protected const PATH_PARAMS = array (
);
    protected const BODY_REQUIRED = true;
}