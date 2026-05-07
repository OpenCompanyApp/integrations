<?php

namespace OpenCompany\Integrations\Fastly\Tools;

/**
 * Get services with product enabled
 *
 * Maps to Fastly generated client operation ProductFanoutApi::getServicesProductFanout (GET /enabled-products/v1/fanout/services).
 */
class FastlyProductFanoutGetServicesProductFanout extends AbstractFastlyTool
{
    protected const NAME = 'fastly_product_fanout_get_services_product_fanout';
    protected const DESCRIPTION = 'Get services with product enabled

Official Fastly client operation: ProductFanoutApi::getServicesProductFanout
Endpoint: GET /enabled-products/v1/fanout/services

Get services with product enabled';
    protected const PARAMETERS = array (
);
    protected const OPERATION = array (
  'slug' => 'fastly_product_fanout_get_services_product_fanout',
  'class' => 'FastlyProductFanoutGetServicesProductFanout',
  'api_class' => 'ProductFanoutApi',
  'method_name' => 'getServicesProductFanout',
  'method' => 'GET',
  'path' => '/enabled-products/v1/fanout/services',
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
