<?php

namespace OpenCompany\Integrations\Plaid\Tools;

/**
 * Terminate products for an Item.
 *
 * Maps to the official Plaid endpoint post /item/products/terminate.
 */
class PlaidItemProductsTerminate extends AbstractPlaidTool
{
    protected const NAME = 'plaid_item_products_terminate';
    protected const DESCRIPTION = 'Terminate products for an Item

Official Plaid endpoint: POST /item/products/terminate

The `/item/products/terminate` endpoint allows you to terminate an Item. Once terminated, the `access_token` associated with the Item is no longer valid, billing for the Item\'s products is ended, and relevant webhooks are fired. `/item/products/terminate` is the recommended way to offboard users or disconnect accounts linked via Plaid.';
    protected const PARAMETERS = array (
  'body' =>
  array (
    'type' => 'object',
    'required' => true,
    'description' => 'JSON request body matching the official Plaid OpenAPI request schema for this operation.',
  ),
);
    protected const METHOD = 'post';
    protected const PATH = '/item/products/terminate';
    protected const PATH_PARAMS = array (
);
    protected const BODY_REQUIRED = true;
}