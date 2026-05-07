<?php

namespace OpenCompany\Integrations\Fastly\Tools;

/**
 * Disable product
 *
 * Maps to Fastly generated client operation ProductImageOptimizerApi::disableProductImageOptimizer (DELETE /enabled-products/v1/image_optimizer/services/{service_id}).
 */
class FastlyProductImageOptimizerDisableProductImageOptimizer extends AbstractFastlyTool
{
    protected const NAME = 'fastly_product_image_optimizer_disable_product_image_optimizer';
    protected const DESCRIPTION = 'Disable product

Official Fastly client operation: ProductImageOptimizerApi::disableProductImageOptimizer
Endpoint: DELETE /enabled-products/v1/image_optimizer/services/{service_id}

Disable product';
    protected const PARAMETERS = array (
  'service_id' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Fastly API parameter `service_id`.',
  ),
);
    protected const OPERATION = array (
  'slug' => 'fastly_product_image_optimizer_disable_product_image_optimizer',
  'class' => 'FastlyProductImageOptimizerDisableProductImageOptimizer',
  'api_class' => 'ProductImageOptimizerApi',
  'method_name' => 'disableProductImageOptimizer',
  'method' => 'DELETE',
  'path' => '/enabled-products/v1/image_optimizer/services/{service_id}',
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
