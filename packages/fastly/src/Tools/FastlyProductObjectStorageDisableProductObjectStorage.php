<?php

namespace OpenCompany\Integrations\Fastly\Tools;

/**
 * Disable product
 *
 * Maps to Fastly generated client operation ProductObjectStorageApi::disableProductObjectStorage (DELETE /enabled-products/v1/object_storage).
 */
class FastlyProductObjectStorageDisableProductObjectStorage extends AbstractFastlyTool
{
    protected const NAME = 'fastly_product_object_storage_disable_product_object_storage';
    protected const DESCRIPTION = 'Disable product

Official Fastly client operation: ProductObjectStorageApi::disableProductObjectStorage
Endpoint: DELETE /enabled-products/v1/object_storage

Disable product';
    protected const PARAMETERS = array (
);
    protected const OPERATION = array (
  'slug' => 'fastly_product_object_storage_disable_product_object_storage',
  'class' => 'FastlyProductObjectStorageDisableProductObjectStorage',
  'api_class' => 'ProductObjectStorageApi',
  'method_name' => 'disableProductObjectStorage',
  'method' => 'DELETE',
  'path' => '/enabled-products/v1/object_storage',
  'hosts' =>
  array (
    0 => 'https://api.fastly.com',
  ),
  'operation_host' => 'https://api.fastly.com',
  'name' => 'Disable product',
  'description' => 'Disable product',
  'type' => 'write',
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
