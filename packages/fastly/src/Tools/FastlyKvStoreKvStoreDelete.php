<?php

namespace OpenCompany\Integrations\Fastly\Tools;

/**
 * Delete a KV store.
 *
 * Maps to Fastly generated client operation KvStoreApi::kvStoreDelete (DELETE /resources/stores/kv/{store_id}).
 */
class FastlyKvStoreKvStoreDelete extends AbstractFastlyTool
{
    protected const NAME = 'fastly_kv_store_kv_store_delete';
    protected const DESCRIPTION = 'Delete a KV store.

Official Fastly client operation: KvStoreApi::kvStoreDelete
Endpoint: DELETE /resources/stores/kv/{store_id}

Delete a KV store.';
    protected const PARAMETERS = array (
  'store_id' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Fastly API parameter `store_id`.',
  ),
);
    protected const OPERATION = array (
  'slug' => 'fastly_kv_store_kv_store_delete',
  'class' => 'FastlyKvStoreKvStoreDelete',
  'api_class' => 'KvStoreApi',
  'method_name' => 'kvStoreDelete',
  'method' => 'DELETE',
  'path' => '/resources/stores/kv/{store_id}',
  'hosts' =>
  array (
    0 => 'https://api.fastly.com',
  ),
  'operation_host' => 'https://api.fastly.com',
  'name' => 'Delete a KV store.',
  'description' => 'Delete a KV store.',
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
