<?php

namespace OpenCompany\Integrations\Fastly\Tools;

/**
 * Get configuration
 *
 * Maps to Fastly generated client operation ProductDdosProtectionApi::getProductDdosProtectionConfiguration (GET /enabled-products/v1/ddos_protection/services/{service_id}/configuration).
 */
class FastlyProductDdosProtectionGetProductDdosProtectionConfiguration extends AbstractFastlyTool
{
    protected const NAME = 'fastly_product_ddos_protection_get_product_ddos_protection_configuration';
    protected const DESCRIPTION = 'Get configuration

Official Fastly client operation: ProductDdosProtectionApi::getProductDdosProtectionConfiguration
Endpoint: GET /enabled-products/v1/ddos_protection/services/{service_id}/configuration

Get configuration';
    protected const PARAMETERS = array (
  'service_id' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Fastly API parameter `service_id`.',
  ),
);
    protected const OPERATION = array (
  'slug' => 'fastly_product_ddos_protection_get_product_ddos_protection_configuration',
  'class' => 'FastlyProductDdosProtectionGetProductDdosProtectionConfiguration',
  'api_class' => 'ProductDdosProtectionApi',
  'method_name' => 'getProductDdosProtectionConfiguration',
  'method' => 'GET',
  'path' => '/enabled-products/v1/ddos_protection/services/{service_id}/configuration',
  'hosts' =>
  array (
    0 => 'https://api.fastly.com',
  ),
  'operation_host' => 'https://api.fastly.com',
  'name' => 'Get configuration',
  'description' => 'Get configuration',
  'type' => 'read',
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
