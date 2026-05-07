<?php

namespace OpenCompany\Integrations\Fastly\Tools;

/**
 * Get an apex redirect
 *
 * Maps to Fastly generated client operation ApexRedirectApi::getApexRedirect (GET /apex-redirects/{apex_redirect_id}).
 */
class FastlyApexRedirectGetApexRedirect extends AbstractFastlyTool
{
    protected const NAME = 'fastly_apex_redirect_get_apex_redirect';
    protected const DESCRIPTION = 'Get an apex redirect

Official Fastly client operation: ApexRedirectApi::getApexRedirect
Endpoint: GET /apex-redirects/{apex_redirect_id}

Get an apex redirect';
    protected const PARAMETERS = array (
  'apex_redirect_id' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Fastly API parameter `apex_redirect_id`.',
  ),
);
    protected const OPERATION = array (
  'slug' => 'fastly_apex_redirect_get_apex_redirect',
  'class' => 'FastlyApexRedirectGetApexRedirect',
  'api_class' => 'ApexRedirectApi',
  'method_name' => 'getApexRedirect',
  'method' => 'GET',
  'path' => '/apex-redirects/{apex_redirect_id}',
  'hosts' =>
  array (
    0 => 'https://api.fastly.com',
  ),
  'operation_host' => 'https://api.fastly.com',
  'name' => 'Get an apex redirect',
  'description' => 'Get an apex redirect',
  'type' => 'read',
  'parameters' =>
  array (
    'apex_redirect_id' =>
    array (
      'type' => 'string',
      'required' => true,
      'description' => 'Fastly API parameter `apex_redirect_id`.',
    ),
  ),
  'path_params' =>
  array (
    'apex_redirect_id' => 'apex_redirect_id',
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
