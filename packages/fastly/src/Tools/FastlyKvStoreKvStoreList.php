<?php

namespace OpenCompany\Integrations\Fastly\Tools;

/**
 * List all KV stores.
 *
 * Maps to Fastly generated client operation KvStoreApi::kvStoreList (GET /resources/stores/kv).
 */
class FastlyKvStoreKvStoreList extends AbstractFastlyTool
{
    protected const NAME = 'fastly_kv_store_kv_store_list';
    protected const DESCRIPTION = 'List all KV stores.

Official Fastly client operation: KvStoreApi::kvStoreList
Endpoint: GET /resources/stores/kv

List all KV stores.';
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
  'slug' => 'fastly_kv_store_kv_store_list',
  'class' => 'FastlyKvStoreKvStoreList',
  'api_class' => 'KvStoreApi',
  'method_name' => 'kvStoreList',
  'method' => 'GET',
  'path' => '/resources/stores/kv',
  'hosts' =>
  array (
    0 => 'https://api.fastly.com',
  ),
  'operation_host' => 'https://api.fastly.com',
  'name' => 'List all KV stores.',
  'description' => 'List all KV stores.',
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
