<?php

namespace OpenCompany\Integrations\Fastly\Tools;

/**
 * Get an access key
 *
 * Maps to Fastly generated client operation ObjectStorageAccessKeysApi::getAccessKey (GET /resources/object-storage/access-keys/{access_key}).
 */
class FastlyObjectStorageAccessKeysGetAccessKey extends AbstractFastlyTool
{
    protected const NAME = 'fastly_object_storage_access_keys_get_access_key';
    protected const DESCRIPTION = 'Get an access key

Official Fastly client operation: ObjectStorageAccessKeysApi::getAccessKey
Endpoint: GET /resources/object-storage/access-keys/{access_key}

Get an access key';
    protected const PARAMETERS = array (
  'access_key' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Fastly API parameter `access_key`.',
  ),
);
    protected const OPERATION = array (
  'slug' => 'fastly_object_storage_access_keys_get_access_key',
  'class' => 'FastlyObjectStorageAccessKeysGetAccessKey',
  'api_class' => 'ObjectStorageAccessKeysApi',
  'method_name' => 'getAccessKey',
  'method' => 'GET',
  'path' => '/resources/object-storage/access-keys/{access_key}',
  'hosts' =>
  array (
    0 => 'https://api.fastly.com',
  ),
  'operation_host' => 'https://api.fastly.com',
  'name' => 'Get an access key',
  'description' => 'Get an access key',
  'type' => 'read',
  'parameters' =>
  array (
    'access_key' =>
    array (
      'type' => 'string',
      'required' => true,
      'description' => 'Fastly API parameter `access_key`.',
    ),
  ),
  'path_params' =>
  array (
    'access_key' => 'access_key',
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
