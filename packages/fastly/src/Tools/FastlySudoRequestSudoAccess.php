<?php

namespace OpenCompany\Integrations\Fastly\Tools;

/**
 * Request Sudo access
 *
 * Maps to Fastly generated client operation SudoApi::requestSudoAccess (POST /sudo).
 */
class FastlySudoRequestSudoAccess extends AbstractFastlyTool
{
    protected const NAME = 'fastly_sudo_request_sudo_access';
    protected const DESCRIPTION = 'Request Sudo access

Official Fastly client operation: SudoApi::requestSudoAccess
Endpoint: POST /sudo

Request Sudo access';
    protected const PARAMETERS = array (
  'sudo_request' =>
  array (
    'type' => 'object',
    'required' => false,
    'description' => 'JSON request body matching the Fastly generated client parameter `sudo_request`.',
  ),
  'body' =>
  array (
    'type' => 'object',
    'required' => false,
    'description' => 'Alias for the JSON request body.',
  ),
);
    protected const OPERATION = array (
  'slug' => 'fastly_sudo_request_sudo_access',
  'class' => 'FastlySudoRequestSudoAccess',
  'api_class' => 'SudoApi',
  'method_name' => 'requestSudoAccess',
  'method' => 'POST',
  'path' => '/sudo',
  'hosts' =>
  array (
    0 => 'https://api.fastly.com',
  ),
  'operation_host' => 'https://api.fastly.com',
  'name' => 'Request Sudo access',
  'description' => 'Request Sudo access',
  'type' => 'write',
  'parameters' =>
  array (
    'sudo_request' =>
    array (
      'type' => 'object',
      'required' => false,
      'description' => 'JSON request body matching the Fastly generated client parameter `sudo_request`.',
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
  'body_param' => 'sudo_request',
  'body_required' => false,
);
}
