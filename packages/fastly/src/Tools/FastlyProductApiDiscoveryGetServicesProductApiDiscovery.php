<?php

namespace OpenCompany\Integrations\Fastly\Tools;

/**
 * Get services with product enabled
 *
 * Maps to Fastly generated client operation ProductApiDiscoveryApi::getServicesProductApiDiscovery (GET /enabled-products/v1/api_discovery/services).
 */
class FastlyProductApiDiscoveryGetServicesProductApiDiscovery extends AbstractFastlyTool
{
    protected const NAME = 'fastly_product_api_discovery_get_services_product_api_discovery';
    protected const DESCRIPTION = 'Get services with product enabled

Official Fastly client operation: ProductApiDiscoveryApi::getServicesProductApiDiscovery
Endpoint: GET /enabled-products/v1/api_discovery/services

Get services with product enabled';
    protected const PARAMETERS = array (
);
    protected const OPERATION = array (
  'slug' => 'fastly_product_api_discovery_get_services_product_api_discovery',
  'class' => 'FastlyProductApiDiscoveryGetServicesProductApiDiscovery',
  'api_class' => 'ProductApiDiscoveryApi',
  'method_name' => 'getServicesProductApiDiscovery',
  'method' => 'GET',
  'path' => '/enabled-products/v1/api_discovery/services',
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
