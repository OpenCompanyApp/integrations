<?php

namespace OpenCompany\Integrations\Fastly\Tools;

/**
 * List Header objects
 *
 * Maps to Fastly generated client operation HeaderApi::listHeaderObjects (GET /service/{service_id}/version/{version_id}/header).
 */
class FastlyHeaderListHeaderObjects extends AbstractFastlyTool
{
    protected const NAME = 'fastly_header_list_header_objects';
    protected const DESCRIPTION = 'List Header objects

Official Fastly client operation: HeaderApi::listHeaderObjects
Endpoint: GET /service/{service_id}/version/{version_id}/header

List Header objects';
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
);
    protected const OPERATION = array (
  'slug' => 'fastly_header_list_header_objects',
  'class' => 'FastlyHeaderListHeaderObjects',
  'api_class' => 'HeaderApi',
  'method_name' => 'listHeaderObjects',
  'method' => 'GET',
  'path' => '/service/{service_id}/version/{version_id}/header',
  'hosts' =>
  array (
    0 => 'https://api.fastly.com',
  ),
  'operation_host' => 'https://api.fastly.com',
  'name' => 'List Header objects',
  'description' => 'List Header objects',
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
  ),
  'path_params' =>
  array (
    'service_id' => 'service_id',
    'version_id' => 'version_id',
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
