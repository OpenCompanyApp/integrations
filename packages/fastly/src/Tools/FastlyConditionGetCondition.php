<?php

namespace OpenCompany\Integrations\Fastly\Tools;

/**
 * Describe a condition
 *
 * Maps to Fastly generated client operation ConditionApi::getCondition (GET /service/{service_id}/version/{version_id}/condition/{condition_name}).
 */
class FastlyConditionGetCondition extends AbstractFastlyTool
{
    protected const NAME = 'fastly_condition_get_condition';
    protected const DESCRIPTION = 'Describe a condition

Official Fastly client operation: ConditionApi::getCondition
Endpoint: GET /service/{service_id}/version/{version_id}/condition/{condition_name}

Describe a condition';
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
  'condition_name' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Fastly API parameter `condition_name`.',
  ),
);
    protected const OPERATION = array (
  'slug' => 'fastly_condition_get_condition',
  'class' => 'FastlyConditionGetCondition',
  'api_class' => 'ConditionApi',
  'method_name' => 'getCondition',
  'method' => 'GET',
  'path' => '/service/{service_id}/version/{version_id}/condition/{condition_name}',
  'hosts' =>
  array (
    0 => 'https://api.fastly.com',
  ),
  'operation_host' => 'https://api.fastly.com',
  'name' => 'Describe a condition',
  'description' => 'Describe a condition',
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
    'condition_name' =>
    array (
      'type' => 'string',
      'required' => true,
      'description' => 'Fastly API parameter `condition_name`.',
    ),
  ),
  'path_params' =>
  array (
    'service_id' => 'service_id',
    'version_id' => 'version_id',
    'condition_name' => 'condition_name',
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
