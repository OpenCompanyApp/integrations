<?php

namespace OpenCompany\Integrations\Fastly\Tools;

/**
 * Get services with product enabled
 *
 * Maps to Fastly generated client operation ProductWebsocketsApi::getServicesProductWebsockets (GET /enabled-products/v1/websockets/services).
 */
class FastlyProductWebsocketsGetServicesProductWebsockets extends AbstractFastlyTool
{
    protected const NAME = 'fastly_product_websockets_get_services_product_websockets';
    protected const DESCRIPTION = 'Get services with product enabled

Official Fastly client operation: ProductWebsocketsApi::getServicesProductWebsockets
Endpoint: GET /enabled-products/v1/websockets/services

Get services with product enabled';
    protected const PARAMETERS = array (
);
    protected const OPERATION = array (
  'slug' => 'fastly_product_websockets_get_services_product_websockets',
  'class' => 'FastlyProductWebsocketsGetServicesProductWebsockets',
  'api_class' => 'ProductWebsocketsApi',
  'method_name' => 'getServicesProductWebsockets',
  'method' => 'GET',
  'path' => '/enabled-products/v1/websockets/services',
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
