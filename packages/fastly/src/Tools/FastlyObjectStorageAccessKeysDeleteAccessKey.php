<?php

namespace OpenCompany\Integrations\Fastly\Tools;

/**
 * Delete an access key
 *
 * Maps to Fastly generated client operation ObjectStorageAccessKeysApi::deleteAccessKey (DELETE /resources/object-storage/access-keys/{access_key}).
 */
class FastlyObjectStorageAccessKeysDeleteAccessKey extends AbstractFastlyTool
{
    protected const NAME = 'fastly_object_storage_access_keys_delete_access_key';
    protected const DESCRIPTION = 'Delete an access key

Official Fastly client operation: ObjectStorageAccessKeysApi::deleteAccessKey
Endpoint: DELETE /resources/object-storage/access-keys/{access_key}

Delete an access key';
    protected const PARAMETERS = array (
  'access_key' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Fastly API parameter `access_key`.',
  ),
);
    protected const OPERATION = array (
  'slug' => 'fastly_object_storage_access_keys_delete_access_key',
  'class' => 'FastlyObjectStorageAccessKeysDeleteAccessKey',
  'api_class' => 'ObjectStorageAccessKeysApi',
  'method_name' => 'deleteAccessKey',
  'method' => 'DELETE',
  'path' => '/resources/object-storage/access-keys/{access_key}',
  'hosts' =>
  array (
    0 => 'https://api.fastly.com',
  ),
  'operation_host' => 'https://api.fastly.com',
  'name' => 'Delete an access key',
  'description' => 'Delete an access key',
  'type' => 'write',
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
