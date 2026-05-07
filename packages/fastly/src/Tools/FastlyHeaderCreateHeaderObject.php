<?php

namespace OpenCompany\Integrations\Fastly\Tools;

/**
 * Create a Header object
 *
 * Maps to Fastly generated client operation HeaderApi::createHeaderObject (POST /service/{service_id}/version/{version_id}/header).
 */
class FastlyHeaderCreateHeaderObject extends AbstractFastlyTool
{
    protected const NAME = 'fastly_header_create_header_object';
    protected const DESCRIPTION = 'Create a Header object

Official Fastly client operation: HeaderApi::createHeaderObject
Endpoint: POST /service/{service_id}/version/{version_id}/header

Create a Header object';
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
  'action' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Fastly API parameter `action`.',
  ),
  'cache_condition' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Fastly API parameter `cache_condition`.',
  ),
  'dst' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Fastly API parameter `dst`.',
  ),
  'name' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Fastly API parameter `name`.',
  ),
  'regex' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Fastly API parameter `regex`.',
  ),
  'request_condition' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Fastly API parameter `request_condition`.',
  ),
  'response_condition' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Fastly API parameter `response_condition`.',
  ),
  'src' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Fastly API parameter `src`.',
  ),
  'substitution' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Fastly API parameter `substitution`.',
  ),
  'type' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Fastly API parameter `type`.',
  ),
  'ignore_if_set' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Fastly API parameter `ignore_if_set`.',
  ),
  'priority' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Fastly API parameter `priority`.',
  ),
);
    protected const OPERATION = array (
  'slug' => 'fastly_header_create_header_object',
  'class' => 'FastlyHeaderCreateHeaderObject',
  'api_class' => 'HeaderApi',
  'method_name' => 'createHeaderObject',
  'method' => 'POST',
  'path' => '/service/{service_id}/version/{version_id}/header',
  'hosts' =>
  array (
    0 => 'https://api.fastly.com',
  ),
  'operation_host' => 'https://api.fastly.com',
  'name' => 'Create a Header object',
  'description' => 'Create a Header object',
  'type' => 'write',
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
    'action' =>
    array (
      'type' => 'string',
      'required' => false,
      'description' => 'Fastly API parameter `action`.',
    ),
    'cache_condition' =>
    array (
      'type' => 'string',
      'required' => false,
      'description' => 'Fastly API parameter `cache_condition`.',
    ),
    'dst' =>
    array (
      'type' => 'string',
      'required' => false,
      'description' => 'Fastly API parameter `dst`.',
    ),
    'name' =>
    array (
      'type' => 'string',
      'required' => false,
      'description' => 'Fastly API parameter `name`.',
    ),
    'regex' =>
    array (
      'type' => 'string',
      'required' => false,
      'description' => 'Fastly API parameter `regex`.',
    ),
    'request_condition' =>
    array (
      'type' => 'string',
      'required' => false,
      'description' => 'Fastly API parameter `request_condition`.',
    ),
    'response_condition' =>
    array (
      'type' => 'string',
      'required' => false,
      'description' => 'Fastly API parameter `response_condition`.',
    ),
    'src' =>
    array (
      'type' => 'string',
      'required' => false,
      'description' => 'Fastly API parameter `src`.',
    ),
    'substitution' =>
    array (
      'type' => 'string',
      'required' => false,
      'description' => 'Fastly API parameter `substitution`.',
    ),
    'type' =>
    array (
      'type' => 'string',
      'required' => false,
      'description' => 'Fastly API parameter `type`.',
    ),
    'ignore_if_set' =>
    array (
      'type' => 'string',
      'required' => false,
      'description' => 'Fastly API parameter `ignore_if_set`.',
    ),
    'priority' =>
    array (
      'type' => 'string',
      'required' => false,
      'description' => 'Fastly API parameter `priority`.',
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
    'action' => 'action',
    'cache_condition' => 'cache_condition',
    'dst' => 'dst',
    'name' => 'name',
    'regex' => 'regex',
    'request_condition' => 'request_condition',
    'response_condition' => 'response_condition',
    'src' => 'src',
    'substitution' => 'substitution',
    'type' => 'type',
    'ignore_if_set' => 'ignore_if_set',
    'priority' => 'priority',
  ),
  'body_param' => NULL,
  'body_required' => false,
);
}
