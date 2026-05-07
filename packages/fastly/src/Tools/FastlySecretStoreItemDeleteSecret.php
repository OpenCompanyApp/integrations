<?php

namespace OpenCompany\Integrations\Fastly\Tools;

/**
 * Delete a secret from a store.
 *
 * Maps to Fastly generated client operation SecretStoreItemApi::deleteSecret (DELETE /resources/stores/secret/{store_id}/secrets/{secret_name}).
 */
class FastlySecretStoreItemDeleteSecret extends AbstractFastlyTool
{
    protected const NAME = 'fastly_secret_store_item_delete_secret';
    protected const DESCRIPTION = 'Delete a secret from a store.

Official Fastly client operation: SecretStoreItemApi::deleteSecret
Endpoint: DELETE /resources/stores/secret/{store_id}/secrets/{secret_name}

Delete a secret from a store.';
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
  'slug' => 'fastly_secret_store_item_delete_secret',
  'class' => 'FastlySecretStoreItemDeleteSecret',
  'api_class' => 'SecretStoreItemApi',
  'method_name' => 'deleteSecret',
  'method' => 'DELETE',
  'path' => '/resources/stores/secret/{store_id}/secrets/{secret_name}',
  'hosts' =>
  array (
    0 => 'https://api.fastly.com',
  ),
  'operation_host' => 'https://api.fastly.com',
  'name' => 'Delete a secret from a store.',
  'description' => 'Delete a secret from a store.',
  'type' => 'write',
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
