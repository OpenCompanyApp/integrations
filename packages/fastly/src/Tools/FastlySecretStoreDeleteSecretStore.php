<?php

namespace OpenCompany\Integrations\Fastly\Tools;

/**
 * Delete secret store
 *
 * Maps to Fastly generated client operation SecretStoreApi::deleteSecretStore (DELETE /resources/stores/secret/{store_id}).
 */
class FastlySecretStoreDeleteSecretStore extends AbstractFastlyTool
{
    protected const NAME = 'fastly_secret_store_delete_secret_store';
    protected const DESCRIPTION = 'Delete secret store

Official Fastly client operation: SecretStoreApi::deleteSecretStore
Endpoint: DELETE /resources/stores/secret/{store_id}

Delete secret store';
    protected const PARAMETERS = array (
  'store_id' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Fastly API parameter `store_id`.',
  ),
);
    protected const OPERATION = array (
  'slug' => 'fastly_secret_store_delete_secret_store',
  'class' => 'FastlySecretStoreDeleteSecretStore',
  'api_class' => 'SecretStoreApi',
  'method_name' => 'deleteSecretStore',
  'method' => 'DELETE',
  'path' => '/resources/stores/secret/{store_id}',
  'hosts' =>
  array (
    0 => 'https://api.fastly.com',
  ),
  'operation_host' => 'https://api.fastly.com',
  'name' => 'Delete secret store',
  'description' => 'Delete secret store',
  'type' => 'write',
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
