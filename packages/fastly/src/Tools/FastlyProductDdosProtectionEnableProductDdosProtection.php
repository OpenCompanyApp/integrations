<?php

namespace OpenCompany\Integrations\Fastly\Tools;

/**
 * Enable product
 *
 * Maps to Fastly generated client operation ProductDdosProtectionApi::enableProductDdosProtection (PUT /enabled-products/v1/ddos_protection/services/{service_id}).
 */
class FastlyProductDdosProtectionEnableProductDdosProtection extends AbstractFastlyTool
{
    protected const NAME = 'fastly_product_ddos_protection_enable_product_ddos_protection';
    protected const DESCRIPTION = 'Enable product

Official Fastly client operation: ProductDdosProtectionApi::enableProductDdosProtection
Endpoint: PUT /enabled-products/v1/ddos_protection/services/{service_id}

Enable product';
    protected const PARAMETERS = array (
  'service_id' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Fastly API parameter `service_id`.',
  ),
  'ddos_protection_request_enable_mode' =>
  array (
    'type' => 'object',
    'required' => false,
    'description' => 'JSON request body matching the Fastly generated client parameter `ddos_protection_request_enable_mode`.',
  ),
  'body' =>
  array (
    'type' => 'object',
    'required' => false,
    'description' => 'Alias for the JSON request body.',
  ),
);
    protected const OPERATION = array (
  'slug' => 'fastly_product_ddos_protection_enable_product_ddos_protection',
  'class' => 'FastlyProductDdosProtectionEnableProductDdosProtection',
  'api_class' => 'ProductDdosProtectionApi',
  'method_name' => 'enableProductDdosProtection',
  'method' => 'PUT',
  'path' => '/enabled-products/v1/ddos_protection/services/{service_id}',
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
    'ddos_protection_request_enable_mode' =>
    array (
      'type' => 'object',
      'required' => false,
      'description' => 'JSON request body matching the Fastly generated client parameter `ddos_protection_request_enable_mode`.',
    ),
    'body' =>
    array (
      'type' => 'object',
      'required' => false,
      'description' => 'Alias for the JSON request body.',
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
  'body_param' => 'ddos_protection_request_enable_mode',
  'body_required' => false,
);
}
