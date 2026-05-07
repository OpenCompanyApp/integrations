<?php

namespace OpenCompany\Integrations\Fastly\Tools;

/**
 * List service authorizations
 *
 * Maps to Fastly generated client operation ServiceAuthorizationsApi::listServiceAuthorization (GET /service-authorizations).
 */
class FastlyServiceAuthorizationsListServiceAuthorization extends AbstractFastlyTool
{
    protected const NAME = 'fastly_service_authorizations_list_service_authorization';
    protected const DESCRIPTION = 'List service authorizations

Official Fastly client operation: ServiceAuthorizationsApi::listServiceAuthorization
Endpoint: GET /service-authorizations

List service authorizations';
    protected const PARAMETERS = array (
  'page_number' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Fastly API parameter `page_number`.',
  ),
  'page_size' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Fastly API parameter `page_size`.',
  ),
);
    protected const OPERATION = array (
  'slug' => 'fastly_service_authorizations_list_service_authorization',
  'class' => 'FastlyServiceAuthorizationsListServiceAuthorization',
  'api_class' => 'ServiceAuthorizationsApi',
  'method_name' => 'listServiceAuthorization',
  'method' => 'GET',
  'path' => '/service-authorizations',
  'hosts' =>
  array (
    0 => 'https://api.fastly.com',
  ),
  'operation_host' => 'https://api.fastly.com',
  'name' => 'List service authorizations',
  'description' => 'List service authorizations',
  'type' => 'read',
  'parameters' =>
  array (
    'page_number' =>
    array (
      'type' => 'string',
      'required' => false,
      'description' => 'Fastly API parameter `page_number`.',
    ),
    'page_size' =>
    array (
      'type' => 'string',
      'required' => false,
      'description' => 'Fastly API parameter `page_size`.',
    ),
  ),
  'path_params' =>
  array (
  ),
  'query_params' =>
  array (
    'page[number]' => 'page_number',
    'page[size]' => 'page_size',
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
