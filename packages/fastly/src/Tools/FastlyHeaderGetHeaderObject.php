<?php

namespace OpenCompany\Integrations\Fastly\Tools;

/**
 * Get a Header object
 *
 * Maps to Fastly generated client operation HeaderApi::getHeaderObject (GET /service/{service_id}/version/{version_id}/header/{header_name}).
 */
class FastlyHeaderGetHeaderObject extends AbstractFastlyTool
{
    protected const NAME = 'fastly_header_get_header_object';
    protected const DESCRIPTION = 'Get a Header object

Official Fastly client operation: HeaderApi::getHeaderObject
Endpoint: GET /service/{service_id}/version/{version_id}/header/{header_name}

Get a Header object';
    protected const PARAMETERS = array (
  'service_id' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Fastly API parameter `service_id`.',
  ),
  'version_id' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Fastly API parameter `version_id`.',
  ),
  'header_name' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Fastly API parameter `header_name`.',
  ),
);
    protected const OPERATION = array (
  'slug' => 'fastly_header_get_header_object',
  'class' => 'FastlyHeaderGetHeaderObject',
  'api_class' => 'HeaderApi',
  'method_name' => 'getHeaderObject',
  'method' => 'GET',
  'path' => '/service/{service_id}/version/{version_id}/header/{header_name}',
  'hosts' =>
  array (
    0 => 'https://api.fastly.com',
  ),
  'operation_host' => 'https://api.fastly.com',
  'name' => 'Get a Header object',
  'description' => 'Get a Header object',
  'type' => 'read',
  'parameters' =>
  array (
    'service_id' =>
    array (
      'type' => 'string',
      'required' => true,
      'description' => 'Fastly API parameter `service_id`.',
    ),
    'version_id' =>
    array (
      'type' => 'string',
      'required' => true,
      'description' => 'Fastly API parameter `version_id`.',
    ),
    'header_name' =>
    array (
      'type' => 'string',
      'required' => true,
      'description' => 'Fastly API parameter `header_name`.',
    ),
  ),
  'path_params' =>
  array (
    'service_id' => 'service_id',
    'version_id' => 'version_id',
    'header_name' => 'header_name',
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
