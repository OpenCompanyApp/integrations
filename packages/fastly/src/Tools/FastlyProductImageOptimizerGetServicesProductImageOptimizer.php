<?php

namespace OpenCompany\Integrations\Fastly\Tools;

/**
 * Get services with product enabled
 *
 * Maps to Fastly generated client operation ProductImageOptimizerApi::getServicesProductImageOptimizer (GET /enabled-products/v1/image_optimizer/services).
 */
class FastlyProductImageOptimizerGetServicesProductImageOptimizer extends AbstractFastlyTool
{
    protected const NAME = 'fastly_product_image_optimizer_get_services_product_image_optimizer';
    protected const DESCRIPTION = 'Get services with product enabled

Official Fastly client operation: ProductImageOptimizerApi::getServicesProductImageOptimizer
Endpoint: GET /enabled-products/v1/image_optimizer/services

Get services with product enabled';
    protected const PARAMETERS = array (
);
    protected const OPERATION = array (
  'slug' => 'fastly_product_image_optimizer_get_services_product_image_optimizer',
  'class' => 'FastlyProductImageOptimizerGetServicesProductImageOptimizer',
  'api_class' => 'ProductImageOptimizerApi',
  'method_name' => 'getServicesProductImageOptimizer',
  'method' => 'GET',
  'path' => '/enabled-products/v1/image_optimizer/services',
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
