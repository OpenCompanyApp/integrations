<?php

namespace OpenCompany\Integrations\Fastly\Tools;

/**
 * Enable product
 *
 * Maps to Fastly generated client operation ProductAiAcceleratorApi::enableAiAccelerator (PUT /enabled-products/v1/ai_accelerator).
 */
class FastlyProductAiAcceleratorEnableAiAccelerator extends AbstractFastlyTool
{
    protected const NAME = 'fastly_product_ai_accelerator_enable_ai_accelerator';
    protected const DESCRIPTION = 'Enable product

Official Fastly client operation: ProductAiAcceleratorApi::enableAiAccelerator
Endpoint: PUT /enabled-products/v1/ai_accelerator

Enable product';
    protected const PARAMETERS = array (
);
    protected const OPERATION = array (
  'slug' => 'fastly_product_ai_accelerator_enable_ai_accelerator',
  'class' => 'FastlyProductAiAcceleratorEnableAiAccelerator',
  'api_class' => 'ProductAiAcceleratorApi',
  'method_name' => 'enableAiAccelerator',
  'method' => 'PUT',
  'path' => '/enabled-products/v1/ai_accelerator',
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
