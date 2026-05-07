<?php

namespace OpenCompany\Integrations\Fastly\Tools;

/**
 * Create a KV store.
 *
 * Maps to Fastly generated client operation KvStoreApi::kvStoreCreate (POST /resources/stores/kv).
 */
class FastlyKvStoreKvStoreCreate extends AbstractFastlyTool
{
    protected const NAME = 'fastly_kv_store_kv_store_create';
    protected const DESCRIPTION = 'Create a KV store.

Official Fastly client operation: KvStoreApi::kvStoreCreate
Endpoint: POST /resources/stores/kv

Create a KV store.';
    protected const PARAMETERS = array (
  'location' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Fastly API parameter `location`.',
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
  'slug' => 'fastly_kv_store_kv_store_create',
  'class' => 'FastlyKvStoreKvStoreCreate',
  'api_class' => 'KvStoreApi',
  'method_name' => 'kvStoreCreate',
  'method' => 'POST',
  'path' => '/resources/stores/kv',
  'hosts' =>
  array (
    0 => 'https://api.fastly.com',
  ),
  'operation_host' => 'https://api.fastly.com',
  'name' => 'Create a KV store.',
  'description' => 'Create a KV store.',
  'type' => 'write',
  'parameters' =>
  array (
    'location' =>
    array (
      'type' => 'string',
      'required' => false,
      'description' => 'Fastly API parameter `location`.',
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
  ),
  'query_params' =>
  array (
    'location' => 'location',
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
