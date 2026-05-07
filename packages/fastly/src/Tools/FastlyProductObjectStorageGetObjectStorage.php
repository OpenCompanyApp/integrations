<?php

namespace OpenCompany\Integrations\Fastly\Tools;

/**
 * Get product enablement status
 *
 * Maps to Fastly generated client operation ProductObjectStorageApi::getObjectStorage (GET /enabled-products/v1/object_storage).
 */
class FastlyProductObjectStorageGetObjectStorage extends AbstractFastlyTool
{
    protected const NAME = 'fastly_product_object_storage_get_object_storage';
    protected const DESCRIPTION = 'Get product enablement status

Official Fastly client operation: ProductObjectStorageApi::getObjectStorage
Endpoint: GET /enabled-products/v1/object_storage

Get product enablement status';
    protected const PARAMETERS = array (
);
    protected const OPERATION = array (
  'slug' => 'fastly_product_object_storage_get_object_storage',
  'class' => 'FastlyProductObjectStorageGetObjectStorage',
  'api_class' => 'ProductObjectStorageApi',
  'method_name' => 'getObjectStorage',
  'method' => 'GET',
  'path' => '/enabled-products/v1/object_storage',
  'hosts' =>
  array (
    0 => 'https://api.fastly.com',
  ),
  'operation_host' => 'https://api.fastly.com',
  'name' => 'Get product enablement status',
  'description' => 'Get product enablement status',
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
