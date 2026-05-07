<?php

namespace OpenCompany\Integrations\Fastly\Tools;

/**
 * Get product enablement status
 *
 * Maps to Fastly generated client operation ProductNgwafApi::getProductNgwaf (GET /enabled-products/v1/ngwaf/services/{service_id}).
 */
class FastlyProductNgwafGetProductNgwaf extends AbstractFastlyTool
{
    protected const NAME = 'fastly_product_ngwaf_get_product_ngwaf';
    protected const DESCRIPTION = 'Get product enablement status

Official Fastly client operation: ProductNgwafApi::getProductNgwaf
Endpoint: GET /enabled-products/v1/ngwaf/services/{service_id}

Get product enablement status';
    protected const PARAMETERS = array (
  'service_id' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Fastly API parameter `service_id`.',
  ),
);
    protected const OPERATION = array (
  'slug' => 'fastly_product_ngwaf_get_product_ngwaf',
  'class' => 'FastlyProductNgwafGetProductNgwaf',
  'api_class' => 'ProductNgwafApi',
  'method_name' => 'getProductNgwaf',
  'method' => 'GET',
  'path' => '/enabled-products/v1/ngwaf/services/{service_id}',
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
