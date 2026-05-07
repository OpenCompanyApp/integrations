<?php

namespace OpenCompany\Integrations\Fastly\Tools;

/**
 * List services
 *
 * Maps to Fastly generated client operation ServiceApi::listServices (GET /service).
 */
class FastlyServiceListServices extends AbstractFastlyTool
{
    protected const NAME = 'fastly_service_list_services';
    protected const DESCRIPTION = 'List services

Official Fastly client operation: ServiceApi::listServices
Endpoint: GET /service

List services';
    protected const PARAMETERS = array (
  'page' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Fastly API parameter `page`.',
  ),
  'per_page' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Fastly API parameter `per_page`.',
  ),
  'sort' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Fastly API parameter `sort`.',
  ),
  'direction' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Fastly API parameter `direction`.',
  ),
);
    protected const OPERATION = array (
  'slug' => 'fastly_service_list_services',
  'class' => 'FastlyServiceListServices',
  'api_class' => 'ServiceApi',
  'method_name' => 'listServices',
  'method' => 'GET',
  'path' => '/service',
  'hosts' =>
  array (
    0 => 'https://api.fastly.com',
  ),
  'operation_host' => 'https://api.fastly.com',
  'name' => 'List services',
  'description' => 'List services',
  'type' => 'read',
  'parameters' =>
  array (
    'page' =>
    array (
      'type' => 'string',
      'required' => false,
      'description' => 'Fastly API parameter `page`.',
    ),
    'per_page' =>
    array (
      'type' => 'string',
      'required' => false,
      'description' => 'Fastly API parameter `per_page`.',
    ),
    'sort' =>
    array (
      'type' => 'string',
      'required' => false,
      'description' => 'Fastly API parameter `sort`.',
    ),
    'direction' =>
    array (
      'type' => 'string',
      'required' => false,
      'description' => 'Fastly API parameter `direction`.',
    ),
  ),
  'path_params' =>
  array (
  ),
  'query_params' =>
  array (
    'page' => 'page',
    'per_page' => 'per_page',
    'sort' => 'sort',
    'direction' => 'direction',
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
