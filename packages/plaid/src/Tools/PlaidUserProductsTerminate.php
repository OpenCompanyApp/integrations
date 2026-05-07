<?php

namespace OpenCompany\Integrations\Plaid\Tools;

/**
 * Terminate user-based products.
 *
 * Maps to the official Plaid endpoint post /user/products/terminate.
 */
class PlaidUserProductsTerminate extends AbstractPlaidTool
{
    protected const NAME = 'plaid_user_products_terminate';
    protected const DESCRIPTION = 'Terminate user-based products

Official Plaid endpoint: POST /user/products/terminate

`/user/products/terminate` terminates user-based recurring subscriptions for a given client user. This will remove user-based products (Financial Management, Protect, and CRA products) from all items associated with the user.';
    protected const PARAMETERS = array (
  'body' =>
  array (
    'type' => 'object',
    'required' => true,
    'description' => 'JSON request body matching the official Plaid OpenAPI request schema for this operation.',
  ),
);
    protected const METHOD = 'post';
    protected const PATH = '/user/products/terminate';
    protected const PATH_PARAMS = array (
);
    protected const BODY_REQUIRED = true;
}