<?php

namespace OpenCompany\Integrations\Fastly\Tools;

/**
 * Enable product
 *
 * Maps to Fastly generated client operation ProductOriginInspectorApi::enableProductOriginInspector (PUT /enabled-products/v1/origin_inspector/services/{service_id}).
 */
class FastlyProductOriginInspectorEnableProductOriginInspector extends AbstractFastlyTool
{
    protected const NAME = 'fastly_product_origin_inspector_enable_product_origin_inspector';
    protected const DESCRIPTION = 'Enable product

Official Fastly client operation: ProductOriginInspectorApi::enableProductOriginInspector
Endpoint: PUT /enabled-products/v1/origin_inspector/services/{service_id}

Enable product';
    protected const PARAMETERS = array (
  'service_id' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Fastly API parameter `service_id`.',
  ),
);
    protected const OPERATION = array (
  'slug' => 'fastly_product_origin_inspector_enable_product_origin_inspector',
  'class' => 'FastlyProductOriginInspectorEnableProductOriginInspector',
  'api_class' => 'ProductOriginInspectorApi',
  'method_name' => 'enableProductOriginInspector',
  'method' => 'PUT',
  'path' => '/enabled-products/v1/origin_inspector/services/{service_id}',
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
    'service_id' =>
    array (
      'type' => 'string',
      'required' => true,
      'description' => 'Fastly API parameter `service_id`.',
    ),
  ),
  'path_params' =>
  array (
    'service_id' => 'service_id',
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
