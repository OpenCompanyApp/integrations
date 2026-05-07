<?php

namespace OpenCompany\Integrations\Fastly\Tools;

/**
 * List secrets within a store.
 *
 * Maps to Fastly generated client operation SecretStoreItemApi::getSecrets (GET /resources/stores/secret/{store_id}/secrets).
 */
class FastlySecretStoreItemGetSecrets extends AbstractFastlyTool
{
    protected const NAME = 'fastly_secret_store_item_get_secrets';
    protected const DESCRIPTION = 'List secrets within a store.

Official Fastly client operation: SecretStoreItemApi::getSecrets
Endpoint: GET /resources/stores/secret/{store_id}/secrets

List secrets within a store.';
    protected const PARAMETERS = array (
  'store_id' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Fastly API parameter `store_id`.',
  ),
  'cursor' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Fastly API parameter `cursor`.',
  ),
  'limit' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Fastly API parameter `limit`.',
  ),
);
    protected const OPERATION = array (
  'slug' => 'fastly_secret_store_item_get_secrets',
  'class' => 'FastlySecretStoreItemGetSecrets',
  'api_class' => 'SecretStoreItemApi',
  'method_name' => 'getSecrets',
  'method' => 'GET',
  'path' => '/resources/stores/secret/{store_id}/secrets',
  'hosts' =>
  array (
    0 => 'https://api.fastly.com',
  ),
  'operation_host' => 'https://api.fastly.com',
  'name' => 'List secrets within a store.',
  'description' => 'List secrets within a store.',
  'type' => 'read',
  'parameters' =>
  array (
    'store_id' =>
    array (
      'type' => 'string',
      'required' => true,
      'description' => 'Fastly API parameter `store_id`.',
    ),
    'cursor' =>
    array (
      'type' => 'string',
      'required' => false,
      'description' => 'Fastly API parameter `cursor`.',
    ),
    'limit' =>
    array (
      'type' => 'string',
      'required' => false,
      'description' => 'Fastly API parameter `limit`.',
    ),
  ),
  'path_params' =>
  array (
    'store_id' => 'store_id',
  ),
  'query_params' =>
  array (
    'cursor' => 'cursor',
    'limit' => 'limit',
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
