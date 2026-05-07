<?php

namespace OpenCompany\Integrations\Fastly\Tools;

/**
 * Update configuration
 *
 * Maps to Fastly generated client operation ProductDdosProtectionApi::setProductDdosProtectionConfiguration (PATCH /enabled-products/v1/ddos_protection/services/{service_id}/configuration).
 */
class FastlyProductDdosProtectionSetProductDdosProtectionConfiguration extends AbstractFastlyTool
{
    protected const NAME = 'fastly_product_ddos_protection_set_product_ddos_protection_configuration';
    protected const DESCRIPTION = 'Update configuration

Official Fastly client operation: ProductDdosProtectionApi::setProductDdosProtectionConfiguration
Endpoint: PATCH /enabled-products/v1/ddos_protection/services/{service_id}/configuration

Update configuration';
    protected const PARAMETERS = array (
  'service_id' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Fastly API parameter `service_id`.',
  ),
  'ddos_protection_request_update_configuration' =>
  array (
    'type' => 'object',
    'required' => false,
    'description' => 'JSON request body matching the Fastly generated client parameter `ddos_protection_request_update_configuration`.',
  ),
  'body' =>
  array (
    'type' => 'object',
    'required' => false,
    'description' => 'Alias for the JSON request body.',
  ),
);
    protected const OPERATION = array (
  'slug' => 'fastly_product_ddos_protection_set_product_ddos_protection_configuration',
  'class' => 'FastlyProductDdosProtectionSetProductDdosProtectionConfiguration',
  'api_class' => 'ProductDdosProtectionApi',
  'method_name' => 'setProductDdosProtectionConfiguration',
  'method' => 'PATCH',
  'path' => '/enabled-products/v1/ddos_protection/services/{service_id}/configuration',
  'hosts' =>
  array (
    0 => 'https://api.fastly.com',
  ),
  'operation_host' => 'https://api.fastly.com',
  'name' => 'Update configuration',
  'description' => 'Update configuration',
  'type' => 'write',
  'parameters' =>
  array (
    'service_id' =>
    array (
      'type' => 'string',
      'required' => true,
      'description' => 'Fastly API parameter `service_id`.',
    ),
    'ddos_protection_request_update_configuration' =>
    array (
      'type' => 'object',
      'required' => false,
      'description' => 'JSON request body matching the Fastly generated client parameter `ddos_protection_request_update_configuration`.',
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
  'body_param' => 'ddos_protection_request_update_configuration',
  'body_required' => false,
);
}
