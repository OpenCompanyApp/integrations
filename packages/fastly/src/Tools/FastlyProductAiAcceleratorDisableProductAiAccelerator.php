<?php

namespace OpenCompany\Integrations\Fastly\Tools;

/**
 * Disable product
 *
 * Maps to Fastly generated client operation ProductAiAcceleratorApi::disableProductAiAccelerator (DELETE /enabled-products/v1/ai_accelerator).
 */
class FastlyProductAiAcceleratorDisableProductAiAccelerator extends AbstractFastlyTool
{
    protected const NAME = 'fastly_product_ai_accelerator_disable_product_ai_accelerator';
    protected const DESCRIPTION = 'Disable product

Official Fastly client operation: ProductAiAcceleratorApi::disableProductAiAccelerator
Endpoint: DELETE /enabled-products/v1/ai_accelerator

Disable product';
    protected const PARAMETERS = array (
);
    protected const OPERATION = array (
  'slug' => 'fastly_product_ai_accelerator_disable_product_ai_accelerator',
  'class' => 'FastlyProductAiAcceleratorDisableProductAiAccelerator',
  'api_class' => 'ProductAiAcceleratorApi',
  'method_name' => 'disableProductAiAccelerator',
  'method' => 'DELETE',
  'path' => '/enabled-products/v1/ai_accelerator',
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
