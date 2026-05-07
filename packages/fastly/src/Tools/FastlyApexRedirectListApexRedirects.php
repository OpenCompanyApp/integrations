<?php

namespace OpenCompany\Integrations\Fastly\Tools;

/**
 * List apex redirects
 *
 * Maps to Fastly generated client operation ApexRedirectApi::listApexRedirects (GET /service/{service_id}/version/{version_id}/apex-redirects).
 */
class FastlyApexRedirectListApexRedirects extends AbstractFastlyTool
{
    protected const NAME = 'fastly_apex_redirect_list_apex_redirects';
    protected const DESCRIPTION = 'List apex redirects

Official Fastly client operation: ApexRedirectApi::listApexRedirects
Endpoint: GET /service/{service_id}/version/{version_id}/apex-redirects

List apex redirects';
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
);
    protected const OPERATION = array (
  'slug' => 'fastly_apex_redirect_list_apex_redirects',
  'class' => 'FastlyApexRedirectListApexRedirects',
  'api_class' => 'ApexRedirectApi',
  'method_name' => 'listApexRedirects',
  'method' => 'GET',
  'path' => '/service/{service_id}/version/{version_id}/apex-redirects',
  'hosts' =>
  array (
    0 => 'https://api.fastly.com',
  ),
  'operation_host' => 'https://api.fastly.com',
  'name' => 'List apex redirects',
  'description' => 'List apex redirects',
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
  ),
  'body_param' => NULL,
  'body_required' => false,
);
}
