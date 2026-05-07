<?php

namespace OpenCompany\Integrations\Fastly\Tools;

/**
 * Show service authorization
 *
 * Maps to Fastly generated client operation ServiceAuthorizationsApi::showServiceAuthorization (GET /service-authorizations/{service_authorization_id}).
 */
class FastlyServiceAuthorizationsShowServiceAuthorization extends AbstractFastlyTool
{
    protected const NAME = 'fastly_service_authorizations_show_service_authorization';
    protected const DESCRIPTION = 'Show service authorization

Official Fastly client operation: ServiceAuthorizationsApi::showServiceAuthorization
Endpoint: GET /service-authorizations/{service_authorization_id}

Show service authorization';
    protected const PARAMETERS = array (
  'service_authorization_id' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Fastly API parameter `service_authorization_id`.',
  ),
);
    protected const OPERATION = array (
  'slug' => 'fastly_service_authorizations_show_service_authorization',
  'class' => 'FastlyServiceAuthorizationsShowServiceAuthorization',
  'api_class' => 'ServiceAuthorizationsApi',
  'method_name' => 'showServiceAuthorization',
  'method' => 'GET',
  'path' => '/service-authorizations/{service_authorization_id}',
  'hosts' =>
  array (
    0 => 'https://api.fastly.com',
  ),
  'operation_host' => 'https://api.fastly.com',
  'name' => 'Show service authorization',
  'description' => 'Show service authorization',
  'type' => 'read',
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
