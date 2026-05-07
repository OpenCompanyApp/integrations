<?php

namespace OpenCompany\Integrations\Fastly\Tools;

/**
 * Get services with product enabled
 *
 * Maps to Fastly generated client operation ProductOriginInspectorApi::getServicesProductOriginInspector (GET /enabled-products/v1/origin_inspector/services).
 */
class FastlyProductOriginInspectorGetServicesProductOriginInspector extends AbstractFastlyTool
{
    protected const NAME = 'fastly_product_origin_inspector_get_services_product_origin_inspector';
    protected const DESCRIPTION = 'Get services with product enabled

Official Fastly client operation: ProductOriginInspectorApi::getServicesProductOriginInspector
Endpoint: GET /enabled-products/v1/origin_inspector/services

Get services with product enabled';
    protected const PARAMETERS = array (
);
    protected const OPERATION = array (
  'slug' => 'fastly_product_origin_inspector_get_services_product_origin_inspector',
  'class' => 'FastlyProductOriginInspectorGetServicesProductOriginInspector',
  'api_class' => 'ProductOriginInspectorApi',
  'method_name' => 'getServicesProductOriginInspector',
  'method' => 'GET',
  'path' => '/enabled-products/v1/origin_inspector/services',
  'hosts' =>
  array (
    0 => 'https://api.fastly.com',
  ),
  'operation_host' => 'https://api.fastly.com',
  'name' => 'Get services with product enabled',
  'description' => 'Get services with product enabled',
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
