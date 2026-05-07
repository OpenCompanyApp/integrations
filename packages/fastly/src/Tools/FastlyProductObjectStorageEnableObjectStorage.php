<?php

namespace OpenCompany\Integrations\Fastly\Tools;

/**
 * Enable product
 *
 * Maps to Fastly generated client operation ProductObjectStorageApi::enableObjectStorage (PUT /enabled-products/v1/object_storage).
 */
class FastlyProductObjectStorageEnableObjectStorage extends AbstractFastlyTool
{
    protected const NAME = 'fastly_product_object_storage_enable_object_storage';
    protected const DESCRIPTION = 'Enable product

Official Fastly client operation: ProductObjectStorageApi::enableObjectStorage
Endpoint: PUT /enabled-products/v1/object_storage

Enable product';
    protected const PARAMETERS = array (
);
    protected const OPERATION = array (
  'slug' => 'fastly_product_object_storage_enable_object_storage',
  'class' => 'FastlyProductObjectStorageEnableObjectStorage',
  'api_class' => 'ProductObjectStorageApi',
  'method_name' => 'enableObjectStorage',
  'method' => 'PUT',
  'path' => '/enabled-products/v1/object_storage',
  'hosts' =>
  array (
    0 => 'https://api.fastly.com',
  ),
  'operation_host' => 'https://api.fastly.com',
  'name' => 'Enable product',
  'description' => 'Enable product',
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
