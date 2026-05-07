<?php

namespace OpenCompany\Integrations\Fastly\Tools;

/**
 * Update a KV store.
 *
 * Maps to Fastly generated client operation KvStoreApi::kvStorePut (PUT /resources/stores/kv/{store_id}).
 */
class FastlyKvStoreKvStorePut extends AbstractFastlyTool
{
    protected const NAME = 'fastly_kv_store_kv_store_put';
    protected const DESCRIPTION = 'Update a KV store.

Official Fastly client operation: KvStoreApi::kvStorePut
Endpoint: PUT /resources/stores/kv/{store_id}

Update a KV store.';
    protected const PARAMETERS = array (
  'store_id' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Fastly API parameter `store_id`.',
  ),
  'kv_store_request_create_or_update' =>
  array (
    'type' => 'object',
    'required' => false,
    'description' => 'JSON request body matching the Fastly generated client parameter `kv_store_request_create_or_update`.',
  ),
  'body' =>
  array (
    'type' => 'object',
    'required' => false,
    'description' => 'Alias for the JSON request body.',
  ),
);
    protected const OPERATION = array (
  'slug' => 'fastly_kv_store_kv_store_put',
  'class' => 'FastlyKvStoreKvStorePut',
  'api_class' => 'KvStoreApi',
  'method_name' => 'kvStorePut',
  'method' => 'PUT',
  'path' => '/resources/stores/kv/{store_id}',
  'hosts' =>
  array (
    0 => 'https://api.fastly.com',
  ),
  'operation_host' => 'https://api.fastly.com',
  'name' => 'Update a KV store.',
  'description' => 'Update a KV store.',
  'type' => 'write',
  'parameters' =>
  array (
    'store_id' =>
    array (
      'type' => 'string',
      'required' => true,
      'description' => 'Fastly API parameter `store_id`.',
    ),
    'kv_store_request_create_or_update' =>
    array (
      'type' => 'object',
      'required' => false,
      'description' => 'JSON request body matching the Fastly generated client parameter `kv_store_request_create_or_update`.',
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
  'body_param' => 'kv_store_request_create_or_update',
  'body_required' => false,
);
}
