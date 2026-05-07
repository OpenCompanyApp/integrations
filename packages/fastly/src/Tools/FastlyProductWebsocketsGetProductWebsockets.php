<?php

namespace OpenCompany\Integrations\Fastly\Tools;

/**
 * Get product enablement status
 *
 * Maps to Fastly generated client operation ProductWebsocketsApi::getProductWebsockets (GET /enabled-products/v1/websockets/services/{service_id}).
 */
class FastlyProductWebsocketsGetProductWebsockets extends AbstractFastlyTool
{
    protected const NAME = 'fastly_product_websockets_get_product_websockets';
    protected const DESCRIPTION = 'Get product enablement status

Official Fastly client operation: ProductWebsocketsApi::getProductWebsockets
Endpoint: GET /enabled-products/v1/websockets/services/{service_id}

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
  'slug' => 'fastly_product_websockets_get_product_websockets',
  'class' => 'FastlyProductWebsocketsGetProductWebsockets',
  'api_class' => 'ProductWebsocketsApi',
  'method_name' => 'getProductWebsockets',
  'method' => 'GET',
  'path' => '/enabled-products/v1/websockets/services/{service_id}',
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
