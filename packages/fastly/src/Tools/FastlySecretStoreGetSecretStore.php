<?php

namespace OpenCompany\Integrations\Fastly\Tools;

/**
 * Get secret store by ID
 *
 * Maps to Fastly generated client operation SecretStoreApi::getSecretStore (GET /resources/stores/secret/{store_id}).
 */
class FastlySecretStoreGetSecretStore extends AbstractFastlyTool
{
    protected const NAME = 'fastly_secret_store_get_secret_store';
    protected const DESCRIPTION = 'Get secret store by ID

Official Fastly client operation: SecretStoreApi::getSecretStore
Endpoint: GET /resources/stores/secret/{store_id}

Get secret store by ID';
    protected const PARAMETERS = array (
  'store_id' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Fastly API parameter `store_id`.',
  ),
);
    protected const OPERATION = array (
  'slug' => 'fastly_secret_store_get_secret_store',
  'class' => 'FastlySecretStoreGetSecretStore',
  'api_class' => 'SecretStoreApi',
  'method_name' => 'getSecretStore',
  'method' => 'GET',
  'path' => '/resources/stores/secret/{store_id}',
  'hosts' =>
  array (
    0 => 'https://api.fastly.com',
  ),
  'operation_host' => 'https://api.fastly.com',
  'name' => 'Get secret store by ID',
  'description' => 'Get secret store by ID',
  'type' => 'read',
  'parameters' =>
  array (
    'store_id' =>
    array (
      'type' => 'string',
      'required' => true,
      'description' => 'Fastly API parameter `store_id`.',
    ),
  ),
  'path_params' =>
  array (
    'store_id' => 'store_id',
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
