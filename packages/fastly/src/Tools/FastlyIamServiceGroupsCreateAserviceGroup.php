<?php

namespace OpenCompany\Integrations\Fastly\Tools;

/**
 * Create a service group
 *
 * Maps to Fastly generated client operation IamServiceGroupsApi::createAServiceGroup (POST /service-groups).
 */
class FastlyIamServiceGroupsCreateAserviceGroup extends AbstractFastlyTool
{
    protected const NAME = 'fastly_iam_service_groups_create_aservice_group';
    protected const DESCRIPTION = 'Create a service group

Official Fastly client operation: IamServiceGroupsApi::createAServiceGroup
Endpoint: POST /service-groups

Create a service group';
    protected const PARAMETERS = array (
  'request_body' =>
  array (
    'type' => 'object',
    'required' => false,
    'description' => 'JSON request body matching the Fastly generated client parameter `request_body`.',
  ),
  'body' =>
  array (
    'type' => 'object',
    'required' => false,
    'description' => 'Alias for the JSON request body.',
  ),
);
    protected const OPERATION = array (
  'slug' => 'fastly_iam_service_groups_create_aservice_group',
  'class' => 'FastlyIamServiceGroupsCreateAserviceGroup',
  'api_class' => 'IamServiceGroupsApi',
  'method_name' => 'createAServiceGroup',
  'method' => 'POST',
  'path' => '/service-groups',
  'hosts' =>
  array (
    0 => 'https://api.fastly.com',
  ),
  'operation_host' => 'https://api.fastly.com',
  'name' => 'Create a service group',
  'description' => 'Create a service group',
  'type' => 'write',
  'parameters' =>
  array (
    'request_body' =>
    array (
      'type' => 'object',
      'required' => false,
      'description' => 'JSON request body matching the Fastly generated client parameter `request_body`.',
    ),
    'body' =>
    array (
      'type' => 'object',
      'required' => false,
      'description' => 'Alias for the JSON request body.',
    ),
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
  'body_param' => 'request_body',
  'body_required' => false,
);
}
