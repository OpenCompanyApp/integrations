<?php

namespace OpenCompany\Integrations\Fastly\Tools;

/**
 * Get secret metadata.
 *
 * Maps to Fastly generated client operation SecretStoreItemApi::getSecret (GET /resources/stores/secret/{store_id}/secrets/{secret_name}).
 */
class FastlySecretStoreItemGetSecret extends AbstractFastlyTool
{
    protected const NAME = 'fastly_secret_store_item_get_secret';
    protected const DESCRIPTION = 'Get secret metadata.

Official Fastly client operation: SecretStoreItemApi::getSecret
Endpoint: GET /resources/stores/secret/{store_id}/secrets/{secret_name}

Get secret metadata.';
    protected const PARAMETERS = array (
  'store_id' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Fastly API parameter `store_id`.',
  ),
  'secret_name' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Fastly API parameter `secret_name`.',
  ),
);
    protected const OPERATION = array (
  'slug' => 'fastly_secret_store_item_get_secret',
  'class' => 'FastlySecretStoreItemGetSecret',
  'api_class' => 'SecretStoreItemApi',
  'method_name' => 'getSecret',
  'method' => 'GET',
  'path' => '/resources/stores/secret/{store_id}/secrets/{secret_name}',
  'hosts' =>
  array (
    0 => 'https://api.fastly.com',
  ),
  'operation_host' => 'https://api.fastly.com',
  'name' => 'Get secret metadata.',
  'description' => 'Get secret metadata.',
  'type' => 'read',
  'parameters' =>
  array (
    'store_id' =>
    array (
      'type' => 'string',
      'required' => true,
      'description' => 'Fastly API parameter `store_id`.',
    ),
    'secret_name' =>
    array (
      'type' => 'string',
      'required' => true,
      'description' => 'Fastly API parameter `secret_name`.',
    ),
  ),
  'path_params' =>
  array (
    'store_id' => 'store_id',
    'secret_name' => 'secret_name',
  ),
  'query_params' =>
  array (
  ),
  'header_params' =>
  array (
  ),
  'form_params' =>
  array (
  ),
  'body_param' => NULL,
  'body_required' => false,
);
}
