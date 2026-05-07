<?php

namespace OpenCompany\Integrations\Fastly\Tools;

/**
 * List the domains within a service
 *
 * Maps to Fastly generated client operation ServiceApi::listServiceDomains (GET /service/{service_id}/domain).
 */
class FastlyServiceListServiceDomains extends AbstractFastlyTool
{
    protected const NAME = 'fastly_service_list_service_domains';
    protected const DESCRIPTION = 'List the domains within a service

Official Fastly client operation: ServiceApi::listServiceDomains
Endpoint: GET /service/{service_id}/domain

List the domains within a service';
    protected const PARAMETERS = array (
  'service_id' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Fastly API parameter `service_id`.',
  ),
);
    protected const OPERATION = array (
  'slug' => 'fastly_service_list_service_domains',
  'class' => 'FastlyServiceListServiceDomains',
  'api_class' => 'ServiceApi',
  'method_name' => 'listServiceDomains',
  'method' => 'GET',
  'path' => '/service/{service_id}/domain',
  'hosts' =>
  array (
    0 => 'https://api.fastly.com',
  ),
  'operation_host' => 'https://api.fastly.com',
  'name' => 'List the domains within a service',
  'description' => 'List the domains within a service',
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
