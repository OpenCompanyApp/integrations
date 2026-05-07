<?php

namespace OpenCompany\Integrations\Fastly\Tools;

/**
 * Get services with product enabled
 *
 * Maps to Fastly generated client operation ProductNgwafApi::getServicesProductNgwaf (GET /enabled-products/v1/ngwaf/services).
 */
class FastlyProductNgwafGetServicesProductNgwaf extends AbstractFastlyTool
{
    protected const NAME = 'fastly_product_ngwaf_get_services_product_ngwaf';
    protected const DESCRIPTION = 'Get services with product enabled

Official Fastly client operation: ProductNgwafApi::getServicesProductNgwaf
Endpoint: GET /enabled-products/v1/ngwaf/services

Get services with product enabled';
    protected const PARAMETERS = array (
);
    protected const OPERATION = array (
  'slug' => 'fastly_product_ngwaf_get_services_product_ngwaf',
  'class' => 'FastlyProductNgwafGetServicesProductNgwaf',
  'api_class' => 'ProductNgwafApi',
  'method_name' => 'getServicesProductNgwaf',
  'method' => 'GET',
  'path' => '/enabled-products/v1/ngwaf/services',
  'hosts' =>
  array (
    0 => 'https://api.fastly.com',
  ),
  'operation_host' => 'https://api.fastly.com',
  'name' => 'Get services with product enabled',
  'description' => 'Get services with product enabled',
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
