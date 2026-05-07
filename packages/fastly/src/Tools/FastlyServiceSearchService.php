<?php

namespace OpenCompany\Integrations\Fastly\Tools;

/**
 * Search for a service by name
 *
 * Maps to Fastly generated client operation ServiceApi::searchService (GET /service/search).
 */
class FastlyServiceSearchService extends AbstractFastlyTool
{
    protected const NAME = 'fastly_service_search_service';
    protected const DESCRIPTION = 'Search for a service by name

Official Fastly client operation: ServiceApi::searchService
Endpoint: GET /service/search

Search for a service by name';
    protected const PARAMETERS = array (
  'name' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Fastly API parameter `name`.',
  ),
);
    protected const OPERATION = array (
  'slug' => 'fastly_service_search_service',
  'class' => 'FastlyServiceSearchService',
  'api_class' => 'ServiceApi',
  'method_name' => 'searchService',
  'method' => 'GET',
  'path' => '/service/search',
  'hosts' =>
  array (
    0 => 'https://api.fastly.com',
  ),
  'operation_host' => 'https://api.fastly.com',
  'name' => 'Search for a service by name',
  'description' => 'Search for a service by name',
  'type' => 'read',
  'parameters' =>
  array (
    'name' =>
    array (
      'type' => 'string',
      'required' => true,
      'description' => 'Fastly API parameter `name`.',
    ),
  ),
  'path_params' =>
  array (
  ),
  'query_params' =>
  array (
    'name' => 'name',
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
