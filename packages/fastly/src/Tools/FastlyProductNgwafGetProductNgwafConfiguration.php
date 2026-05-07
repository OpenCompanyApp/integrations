<?php

namespace OpenCompany\Integrations\Fastly\Tools;

/**
 * Get configuration
 *
 * Maps to Fastly generated client operation ProductNgwafApi::getProductNgwafConfiguration (GET /enabled-products/v1/ngwaf/services/{service_id}/configuration).
 */
class FastlyProductNgwafGetProductNgwafConfiguration extends AbstractFastlyTool
{
    protected const NAME = 'fastly_product_ngwaf_get_product_ngwaf_configuration';
    protected const DESCRIPTION = 'Get configuration

Official Fastly client operation: ProductNgwafApi::getProductNgwafConfiguration
Endpoint: GET /enabled-products/v1/ngwaf/services/{service_id}/configuration

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
  'slug' => 'fastly_product_ngwaf_get_product_ngwaf_configuration',
  'class' => 'FastlyProductNgwafGetProductNgwafConfiguration',
  'api_class' => 'ProductNgwafApi',
  'method_name' => 'getProductNgwafConfiguration',
  'method' => 'GET',
  'path' => '/enabled-products/v1/ngwaf/services/{service_id}/configuration',
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
