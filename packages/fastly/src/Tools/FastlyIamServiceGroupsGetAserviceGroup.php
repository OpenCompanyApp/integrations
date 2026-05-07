<?php

namespace OpenCompany\Integrations\Fastly\Tools;

/**
 * Get a service group
 *
 * Maps to Fastly generated client operation IamServiceGroupsApi::getAServiceGroup (GET /service-groups/{service_group_id}).
 */
class FastlyIamServiceGroupsGetAserviceGroup extends AbstractFastlyTool
{
    protected const NAME = 'fastly_iam_service_groups_get_aservice_group';
    protected const DESCRIPTION = 'Get a service group

Official Fastly client operation: IamServiceGroupsApi::getAServiceGroup
Endpoint: GET /service-groups/{service_group_id}

Get a service group';
    protected const PARAMETERS = array (
  'service_group_id' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Fastly API parameter `service_group_id`.',
  ),
);
    protected const OPERATION = array (
  'slug' => 'fastly_iam_service_groups_get_aservice_group',
  'class' => 'FastlyIamServiceGroupsGetAserviceGroup',
  'api_class' => 'IamServiceGroupsApi',
  'method_name' => 'getAServiceGroup',
  'method' => 'GET',
  'path' => '/service-groups/{service_group_id}',
  'hosts' =>
  array (
    0 => 'https://api.fastly.com',
  ),
  'operation_host' => 'https://api.fastly.com',
  'name' => 'Get a service group',
  'description' => 'Get a service group',
  'type' => 'read',
  'parameters' =>
  array (
    'service_group_id' =>
    array (
      'type' => 'string',
      'required' => true,
      'description' => 'Fastly API parameter `service_group_id`.',
    ),
  ),
  'path_params' =>
  array (
    'service_group_id' => 'service_group_id',
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
