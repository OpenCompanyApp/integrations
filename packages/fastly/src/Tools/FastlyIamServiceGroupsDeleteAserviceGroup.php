<?php

namespace OpenCompany\Integrations\Fastly\Tools;

/**
 * Delete a service group
 *
 * Maps to Fastly generated client operation IamServiceGroupsApi::deleteAServiceGroup (DELETE /service-groups/{service_group_id}).
 */
class FastlyIamServiceGroupsDeleteAserviceGroup extends AbstractFastlyTool
{
    protected const NAME = 'fastly_iam_service_groups_delete_aservice_group';
    protected const DESCRIPTION = 'Delete a service group

Official Fastly client operation: IamServiceGroupsApi::deleteAServiceGroup
Endpoint: DELETE /service-groups/{service_group_id}

Delete a service group';
    protected const PARAMETERS = array (
  'service_group_id' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Fastly API parameter `service_group_id`.',
  ),
);
    protected const OPERATION = array (
  'slug' => 'fastly_iam_service_groups_delete_aservice_group',
  'class' => 'FastlyIamServiceGroupsDeleteAserviceGroup',
  'api_class' => 'IamServiceGroupsApi',
  'method_name' => 'deleteAServiceGroup',
  'method' => 'DELETE',
  'path' => '/service-groups/{service_group_id}',
  'hosts' =>
  array (
    0 => 'https://api.fastly.com',
  ),
  'operation_host' => 'https://api.fastly.com',
  'name' => 'Delete a service group',
  'description' => 'Delete a service group',
  'type' => 'write',
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
