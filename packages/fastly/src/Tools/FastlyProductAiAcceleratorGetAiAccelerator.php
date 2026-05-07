<?php

namespace OpenCompany\Integrations\Fastly\Tools;

/**
 * Get product enablement status
 *
 * Maps to Fastly generated client operation ProductAiAcceleratorApi::getAiAccelerator (GET /enabled-products/v1/ai_accelerator).
 */
class FastlyProductAiAcceleratorGetAiAccelerator extends AbstractFastlyTool
{
    protected const NAME = 'fastly_product_ai_accelerator_get_ai_accelerator';
    protected const DESCRIPTION = 'Get product enablement status

Official Fastly client operation: ProductAiAcceleratorApi::getAiAccelerator
Endpoint: GET /enabled-products/v1/ai_accelerator

Get product enablement status';
    protected const PARAMETERS = array (
);
    protected const OPERATION = array (
  'slug' => 'fastly_product_ai_accelerator_get_ai_accelerator',
  'class' => 'FastlyProductAiAcceleratorGetAiAccelerator',
  'api_class' => 'ProductAiAcceleratorApi',
  'method_name' => 'getAiAccelerator',
  'method' => 'GET',
  'path' => '/enabled-products/v1/ai_accelerator',
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
