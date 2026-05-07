<?php

namespace OpenCompany\Integrations\Plaid\Tools;

/**
 * Import Item.
 *
 * Maps to the official Plaid endpoint post /item/import.
 */
class PlaidItemImport extends AbstractPlaidTool
{
    protected const NAME = 'plaid_item_import';
    protected const DESCRIPTION = 'Import Item

Official Plaid endpoint: POST /item/import

`/item/import` creates an Item via your Plaid Exchange Integration and returns an `access_token`. As part of an `/item/import` request, you will include a User ID (`user_auth.user_id`) and Authentication Token (`user_auth.auth_token`) that enable data aggregation through your Plaid Exchange API endpoints. These authentication principals are to be chosen by you. Upon creating an Item via `/item/import`, Plaid will automatically begin an extraction of that Item through the Plaid Exchange infrastructure you have already integrated.';
    protected const PARAMETERS = array (
  'body' =>
  array (
    'type' => 'object',
    'required' => true,
    'description' => 'JSON request body matching the official Plaid OpenAPI request schema for this operation.',
  ),
);
    protected const METHOD = 'post';
    protected const PATH = '/item/import';
    protected const PATH_PARAMS = array (
);
    protected const BODY_REQUIRED = true;
}