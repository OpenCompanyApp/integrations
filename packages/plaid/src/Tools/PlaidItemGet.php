<?php

namespace OpenCompany\Integrations\Plaid\Tools;

/**
 * Retrieve an Item.
 *
 * Maps to the official Plaid endpoint post /item/get.
 */
class PlaidItemGet extends AbstractPlaidTool
{
    protected const NAME = 'plaid_item_get';
    protected const DESCRIPTION = 'Retrieve an Item

Official Plaid endpoint: POST /item/get

Returns information about the status of an Item.';
    protected const PARAMETERS = array (
  'body' =>
  array (
    'type' => 'object',
    'required' => true,
    'description' => 'JSON request body matching the official Plaid OpenAPI request schema for this operation.',
  ),
);
    protected const METHOD = 'post';
    protected const PATH = '/item/get';
    protected const PATH_PARAMS = array (
);
    protected const BODY_REQUIRED = true;
}