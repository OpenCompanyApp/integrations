<?php

namespace OpenCompany\Integrations\Fastly\Tools;

/**
 * Describe a KV store.
 *
 * Maps to Fastly generated client operation KvStoreApi::kvStoreGet (GET /resources/stores/kv/{store_id}).
 */
class FastlyKvStoreKvStoreGet extends AbstractFastlyTool
{
    protected const NAME = 'fastly_kv_store_kv_store_get';
    protected const DESCRIPTION = 'Describe a KV store.

Official Fastly client operation: KvStoreApi::kvStoreGet
Endpoint: GET /resources/stores/kv/{store_id}

Describe a KV store.';
    protected const PARAMETERS = array (
  'store_id' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Fastly API parameter `store_id`.',
  ),
);
    protected const OPERATION = array (
  'slug' => 'fastly_kv_store_kv_store_get',
  'class' => 'FastlyKvStoreKvStoreGet',
  'api_class' => 'KvStoreApi',
  'method_name' => 'kvStoreGet',
  'method' => 'GET',
  'path' => '/resources/stores/kv/{store_id}',
  'hosts' =>
  array (
    0 => 'https://api.fastly.com',
  ),
  'operation_host' => 'https://api.fastly.com',
  'name' => 'Describe a KV store.',
  'description' => 'Describe a KV store.',
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
