<?php

namespace OpenCompany\Integrations\Fastly\Tools;

/**
 * Delete service authorization
 *
 * Maps to Fastly generated client operation ServiceAuthorizationsApi::deleteServiceAuthorization (DELETE /service-authorizations/{service_authorization_id}).
 */
class FastlyServiceAuthorizationsDeleteServiceAuthorization extends AbstractFastlyTool
{
    protected const NAME = 'fastly_service_authorizations_delete_service_authorization';
    protected const DESCRIPTION = 'Delete service authorization

Official Fastly client operation: ServiceAuthorizationsApi::deleteServiceAuthorization
Endpoint: DELETE /service-authorizations/{service_authorization_id}

Delete service authorization';
    protected const PARAMETERS = array (
  'service_authorization_id' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Fastly API parameter `service_authorization_id`.',
  ),
);
    protected const OPERATION = array (
  'slug' => 'fastly_service_authorizations_delete_service_authorization',
  'class' => 'FastlyServiceAuthorizationsDeleteServiceAuthorization',
  'api_class' => 'ServiceAuthorizationsApi',
  'method_name' => 'deleteServiceAuthorization',
  'method' => 'DELETE',
  'path' => '/service-authorizations/{service_authorization_id}',
  'hosts' =>
  array (
    0 => 'https://api.fastly.com',
  ),
  'operation_host' => 'https://api.fastly.com',
  'name' => 'Delete service authorization',
  'description' => 'Delete service authorization',
  'type' => 'write',
  'parameters' =>
  array (
    'service_authorization_id' =>
    array (
      'type' => 'string',
      'required' => true,
      'description' => 'Fastly API parameter `service_authorization_id`.',
    ),
  ),
  'path_params' =>
  array (
    'service_authorization_id' => 'service_authorization_id',
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
