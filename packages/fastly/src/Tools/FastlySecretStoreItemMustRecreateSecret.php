<?php

namespace OpenCompany\Integrations\Fastly\Tools;

/**
 * Recreate a secret in a store.
 *
 * Maps to Fastly generated client operation SecretStoreItemApi::mustRecreateSecret (PATCH /resources/stores/secret/{store_id}/secrets).
 */
class FastlySecretStoreItemMustRecreateSecret extends AbstractFastlyTool
{
    protected const NAME = 'fastly_secret_store_item_must_recreate_secret';
    protected const DESCRIPTION = 'Recreate a secret in a store.

Official Fastly client operation: SecretStoreItemApi::mustRecreateSecret
Endpoint: PATCH /resources/stores/secret/{store_id}/secrets

Recreate a secret in a store.';
    protected const PARAMETERS = array (
  'store_id' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Fastly API parameter `store_id`.',
  ),
  'secret' =>
  array (
    'type' => 'object',
    'required' => false,
    'description' => 'JSON request body matching the Fastly generated client parameter `secret`.',
  ),
  'body' =>
  array (
    'type' => 'object',
    'required' => false,
    'description' => 'Alias for the JSON request body.',
  ),
);
    protected const OPERATION = array (
  'slug' => 'fastly_secret_store_item_must_recreate_secret',
  'class' => 'FastlySecretStoreItemMustRecreateSecret',
  'api_class' => 'SecretStoreItemApi',
  'method_name' => 'mustRecreateSecret',
  'method' => 'PATCH',
  'path' => '/resources/stores/secret/{store_id}/secrets',
  'hosts' =>
  array (
    0 => 'https://api.fastly.com',
  ),
  'operation_host' => 'https://api.fastly.com',
  'name' => 'Recreate a secret in a store.',
  'description' => 'Recreate a secret in a store.',
  'type' => 'write',
  'parameters' =>
  array (
    'store_id' =>
    array (
      'type' => 'string',
      'required' => true,
      'description' => 'Fastly API parameter `store_id`.',
    ),
    'secret' =>
    array (
      'type' => 'object',
      'required' => false,
      'description' => 'JSON request body matching the Fastly generated client parameter `secret`.',
    ),
    'body' =>
    array (
      'type' => 'object',
      'required' => false,
      'description' => 'Alias for the JSON request body.',
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
  'body_param' => 'secret',
  'body_required' => false,
);
}
