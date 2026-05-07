<?php

namespace OpenCompany\Integrations\Plaid\Tools;

/**
 * Get a processor token's product permissions.
 *
 * Maps to the official Plaid endpoint post /processor/token/permissions/get.
 */
class PlaidProcessorTokenPermissionsGet extends AbstractPlaidTool
{
    protected const NAME = 'plaid_processor_token_permissions_get';
    protected const DESCRIPTION = 'Get a processor token\'s product permissions

Official Plaid endpoint: POST /processor/token/permissions/get

Used to get a processor token\'s product permissions. The `products` field will be an empty list if the processor can access all available products.';
    protected const PARAMETERS = array (
  'body' =>
  array (
    'type' => 'object',
    'required' => true,
    'description' => 'JSON request body matching the official Plaid OpenAPI request schema for this operation.',
  ),
);
    protected const METHOD = 'post';
    protected const PATH = '/processor/token/permissions/get';
    protected const PATH_PARAMS = array (
);
    protected const BODY_REQUIRED = true;
}