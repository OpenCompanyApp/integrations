<?php

namespace OpenCompany\Integrations\Fastly\Tools;

/**
 * Get all secret stores
 *
 * Maps to Fastly generated client operation SecretStoreApi::getSecretStores (GET /resources/stores/secret).
 */
class FastlySecretStoreGetSecretStores extends AbstractFastlyTool
{
    protected const NAME = 'fastly_secret_store_get_secret_stores';
    protected const DESCRIPTION = 'Get all secret stores

Official Fastly client operation: SecretStoreApi::getSecretStores
Endpoint: GET /resources/stores/secret

Get all secret stores';
    protected const PARAMETERS = array (
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
  'name' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Fastly API parameter `name`.',
  ),
);
    protected const OPERATION = array (
  'slug' => 'fastly_secret_store_get_secret_stores',
  'class' => 'FastlySecretStoreGetSecretStores',
  'api_class' => 'SecretStoreApi',
  'method_name' => 'getSecretStores',
  'method' => 'GET',
  'path' => '/resources/stores/secret',
  'hosts' =>
  array (
    0 => 'https://api.fastly.com',
  ),
  'operation_host' => 'https://api.fastly.com',
  'name' => 'Get all secret stores',
  'description' => 'Get all secret stores',
  'type' => 'read',
  'parameters' =>
  array (
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
    'name' =>
    array (
      'type' => 'string',
      'required' => false,
      'description' => 'Fastly API parameter `name`.',
    ),
  ),
  'path_params' =>
  array (
  ),
  'query_params' =>
  array (
    'cursor' => 'cursor',
    'limit' => 'limit',
    'name' => 'name',
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
