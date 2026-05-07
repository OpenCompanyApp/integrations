<?php

namespace OpenCompany\Integrations\Fastly\Tools;

/**
 * Create an access key
 *
 * Maps to Fastly generated client operation ObjectStorageAccessKeysApi::createAccessKey (POST /resources/object-storage/access-keys).
 */
class FastlyObjectStorageAccessKeysCreateAccessKey extends AbstractFastlyTool
{
    protected const NAME = 'fastly_object_storage_access_keys_create_access_key';
    protected const DESCRIPTION = 'Create an access key

Official Fastly client operation: ObjectStorageAccessKeysApi::createAccessKey
Endpoint: POST /resources/object-storage/access-keys

Create an access key';
    protected const PARAMETERS = array (
  'access_key' =>
  array (
    'type' => 'object',
    'required' => false,
    'description' => 'JSON request body matching the Fastly generated client parameter `access_key`.',
  ),
  'body' =>
  array (
    'type' => 'object',
    'required' => false,
    'description' => 'Alias for the JSON request body.',
  ),
);
    protected const OPERATION = array (
  'slug' => 'fastly_object_storage_access_keys_create_access_key',
  'class' => 'FastlyObjectStorageAccessKeysCreateAccessKey',
  'api_class' => 'ObjectStorageAccessKeysApi',
  'method_name' => 'createAccessKey',
  'method' => 'POST',
  'path' => '/resources/object-storage/access-keys',
  'hosts' =>
  array (
    0 => 'https://api.fastly.com',
  ),
  'operation_host' => 'https://api.fastly.com',
  'name' => 'Create an access key',
  'description' => 'Create an access key',
  'type' => 'write',
  'parameters' =>
  array (
    'access_key' =>
    array (
      'type' => 'object',
      'required' => false,
      'description' => 'JSON request body matching the Fastly generated client parameter `access_key`.',
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
  ),
  'header_params' =>
  array (
  ),
  'form_params' =>
  array (
  ),
  'body_param' => 'access_key',
  'body_required' => false,
);
}
