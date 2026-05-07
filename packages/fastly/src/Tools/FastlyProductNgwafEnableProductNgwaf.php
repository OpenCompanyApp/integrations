<?php

namespace OpenCompany\Integrations\Fastly\Tools;

/**
 * Enable product
 *
 * Maps to Fastly generated client operation ProductNgwafApi::enableProductNgwaf (PUT /enabled-products/v1/ngwaf/services/{service_id}).
 */
class FastlyProductNgwafEnableProductNgwaf extends AbstractFastlyTool
{
    protected const NAME = 'fastly_product_ngwaf_enable_product_ngwaf';
    protected const DESCRIPTION = 'Enable product

Official Fastly client operation: ProductNgwafApi::enableProductNgwaf
Endpoint: PUT /enabled-products/v1/ngwaf/services/{service_id}

Enable product';
    protected const PARAMETERS = array (
  'service_id' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Fastly API parameter `service_id`.',
  ),
  'ngwaf_request_enable' =>
  array (
    'type' => 'object',
    'required' => false,
    'description' => 'JSON request body matching the Fastly generated client parameter `ngwaf_request_enable`.',
  ),
  'body' =>
  array (
    'type' => 'object',
    'required' => false,
    'description' => 'Alias for the JSON request body.',
  ),
);
    protected const OPERATION = array (
  'slug' => 'fastly_product_ngwaf_enable_product_ngwaf',
  'class' => 'FastlyProductNgwafEnableProductNgwaf',
  'api_class' => 'ProductNgwafApi',
  'method_name' => 'enableProductNgwaf',
  'method' => 'PUT',
  'path' => '/enabled-products/v1/ngwaf/services/{service_id}',
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
    'ngwaf_request_enable' =>
    array (
      'type' => 'object',
      'required' => false,
      'description' => 'JSON request body matching the Fastly generated client parameter `ngwaf_request_enable`.',
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
  'body_param' => 'ngwaf_request_enable',
  'body_required' => false,
);
}
