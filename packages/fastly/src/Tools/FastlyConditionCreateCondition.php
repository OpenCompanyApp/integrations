<?php

namespace OpenCompany\Integrations\Fastly\Tools;

/**
 * Create a condition
 *
 * Maps to Fastly generated client operation ConditionApi::createCondition (POST /service/{service_id}/version/{version_id}/condition).
 */
class FastlyConditionCreateCondition extends AbstractFastlyTool
{
    protected const NAME = 'fastly_condition_create_condition';
    protected const DESCRIPTION = 'Create a condition

Official Fastly client operation: ConditionApi::createCondition
Endpoint: POST /service/{service_id}/version/{version_id}/condition

Create a condition';
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
  'comment' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Fastly API parameter `comment`.',
  ),
  'name' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Fastly API parameter `name`.',
  ),
  'priority' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Fastly API parameter `priority`.',
  ),
  'statement' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Fastly API parameter `statement`.',
  ),
  'version' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Fastly API parameter `version`.',
  ),
  'type' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Fastly API parameter `type`.',
  ),
);
    protected const OPERATION = array (
  'slug' => 'fastly_condition_create_condition',
  'class' => 'FastlyConditionCreateCondition',
  'api_class' => 'ConditionApi',
  'method_name' => 'createCondition',
  'method' => 'POST',
  'path' => '/service/{service_id}/version/{version_id}/condition',
  'hosts' =>
  array (
    0 => 'https://api.fastly.com',
  ),
  'operation_host' => 'https://api.fastly.com',
  'name' => 'Create a condition',
  'description' => 'Create a condition',
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
    'comment' =>
    array (
      'type' => 'string',
      'required' => false,
      'description' => 'Fastly API parameter `comment`.',
    ),
    'name' =>
    array (
      'type' => 'string',
      'required' => false,
      'description' => 'Fastly API parameter `name`.',
    ),
    'priority' =>
    array (
      'type' => 'string',
      'required' => false,
      'description' => 'Fastly API parameter `priority`.',
    ),
    'statement' =>
    array (
      'type' => 'string',
      'required' => false,
      'description' => 'Fastly API parameter `statement`.',
    ),
    'version' =>
    array (
      'type' => 'string',
      'required' => false,
      'description' => 'Fastly API parameter `version`.',
    ),
    'type' =>
    array (
      'type' => 'string',
      'required' => false,
      'description' => 'Fastly API parameter `type`.',
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
    'comment' => 'comment',
    'name' => 'name',
    'priority' => 'priority',
    'statement' => 'statement',
    'service_id' => 'service_id',
    'version' => 'version',
    'type' => 'type',
  ),
  'body_param' => NULL,
  'body_required' => false,
);
}
