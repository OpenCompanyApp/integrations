<?php

namespace OpenCompany\Integrations\Plaid\Tools;

/**
 * Control a processor's access to products.
 *
 * Maps to the official Plaid endpoint post /processor/token/permissions/set.
 */
class PlaidProcessorTokenPermissionsSet extends AbstractPlaidTool
{
    protected const NAME = 'plaid_processor_token_permissions_set';
    protected const DESCRIPTION = 'Control a processor\'s access to products

Official Plaid endpoint: POST /processor/token/permissions/set

Used to control a processor\'s access to products on the given processor token. By default, a processor will have access to all available products on the corresponding item. To restrict access to a particular set of products, call this endpoint with the desired products. To restore access to all available products, call this endpoint with an empty list. This endpoint can be called multiple times as your needs and your processor\'s needs change.';
    protected const PARAMETERS = array (
  'body' =>
  array (
    'type' => 'object',
    'required' => true,
    'description' => 'JSON request body matching the official Plaid OpenAPI request schema for this operation.',
  ),
);
    protected const METHOD = 'post';
    protected const PATH = '/processor/token/permissions/set';
    protected const PATH_PARAMS = array (
);
    protected const BODY_REQUIRED = true;
}