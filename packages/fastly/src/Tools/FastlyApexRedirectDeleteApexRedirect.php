<?php

namespace OpenCompany\Integrations\Fastly\Tools;

/**
 * Delete an apex redirect
 *
 * Maps to Fastly generated client operation ApexRedirectApi::deleteApexRedirect (DELETE /apex-redirects/{apex_redirect_id}).
 */
class FastlyApexRedirectDeleteApexRedirect extends AbstractFastlyTool
{
    protected const NAME = 'fastly_apex_redirect_delete_apex_redirect';
    protected const DESCRIPTION = 'Delete an apex redirect

Official Fastly client operation: ApexRedirectApi::deleteApexRedirect
Endpoint: DELETE /apex-redirects/{apex_redirect_id}

Delete an apex redirect';
    protected const PARAMETERS = array (
  'apex_redirect_id' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Fastly API parameter `apex_redirect_id`.',
  ),
);
    protected const OPERATION = array (
  'slug' => 'fastly_apex_redirect_delete_apex_redirect',
  'class' => 'FastlyApexRedirectDeleteApexRedirect',
  'api_class' => 'ApexRedirectApi',
  'method_name' => 'deleteApexRedirect',
  'method' => 'DELETE',
  'path' => '/apex-redirects/{apex_redirect_id}',
  'hosts' =>
  array (
    0 => 'https://api.fastly.com',
  ),
  'operation_host' => 'https://api.fastly.com',
  'name' => 'Delete an apex redirect',
  'description' => 'Delete an apex redirect',
  'type' => 'write',
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
