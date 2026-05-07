<?php

namespace OpenCompany\Integrations\Fastly\Tools;

/**
 * List access keys
 *
 * Maps to Fastly generated client operation ObjectStorageAccessKeysApi::listAccessKeys (GET /resources/object-storage/access-keys).
 */
class FastlyObjectStorageAccessKeysListAccessKeys extends AbstractFastlyTool
{
    protected const NAME = 'fastly_object_storage_access_keys_list_access_keys';
    protected const DESCRIPTION = 'List access keys

Official Fastly client operation: ObjectStorageAccessKeysApi::listAccessKeys
Endpoint: GET /resources/object-storage/access-keys

List access keys';
    protected const PARAMETERS = array (
);
    protected const OPERATION = array (
  'slug' => 'fastly_object_storage_access_keys_list_access_keys',
  'class' => 'FastlyObjectStorageAccessKeysListAccessKeys',
  'api_class' => 'ObjectStorageAccessKeysApi',
  'method_name' => 'listAccessKeys',
  'method' => 'GET',
  'path' => '/resources/object-storage/access-keys',
  'hosts' =>
  array (
    0 => 'https://api.fastly.com',
  ),
  'operation_host' => 'https://api.fastly.com',
  'name' => 'List access keys',
  'description' => 'List access keys',
  'type' => 'read',
  'parameters' =>
  array (
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
  'body_param' => NULL,
  'body_required' => false,
);
}
