<?php

namespace OpenCompany\Integrations\Fastly\Tools;

/**
 * Delete service authorizations
 *
 * Maps to Fastly generated client operation ServiceAuthorizationsApi::deleteServiceAuthorization2 (DELETE /service-authorizations).
 */
class FastlyServiceAuthorizationsDeleteServiceAuthorization2 extends AbstractFastlyTool
{
    protected const NAME = 'fastly_service_authorizations_delete_service_authorization2';
    protected const DESCRIPTION = 'Delete service authorizations

Official Fastly client operation: ServiceAuthorizationsApi::deleteServiceAuthorization2
Endpoint: DELETE /service-authorizations

Delete service authorizations';
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
  'slug' => 'fastly_service_authorizations_delete_service_authorization2',
  'class' => 'FastlyServiceAuthorizationsDeleteServiceAuthorization2',
  'api_class' => 'ServiceAuthorizationsApi',
  'method_name' => 'deleteServiceAuthorization2',
  'method' => 'DELETE',
  'path' => '/service-authorizations',
  'hosts' =>
  array (
    0 => 'https://api.fastly.com',
  ),
  'operation_host' => 'https://api.fastly.com',
  'name' => 'Delete service authorizations',
  'description' => 'Delete service authorizations',
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
