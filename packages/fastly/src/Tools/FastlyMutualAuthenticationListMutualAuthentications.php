<?php

namespace OpenCompany\Integrations\Fastly\Tools;

/**
 * List Mutual Authentications
 *
 * Maps to Fastly generated client operation MutualAuthenticationApi::listMutualAuthentications (GET /tls/mutual_authentications).
 */
class FastlyMutualAuthenticationListMutualAuthentications extends AbstractFastlyTool
{
    protected const NAME = 'fastly_mutual_authentication_list_mutual_authentications';
    protected const DESCRIPTION = 'List Mutual Authentications

Official Fastly client operation: MutualAuthenticationApi::listMutualAuthentications
Endpoint: GET /tls/mutual_authentications

List Mutual Authentications';
    protected const PARAMETERS = array (
  'include' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Fastly API parameter `include`.',
  ),
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
  'slug' => 'fastly_mutual_authentication_list_mutual_authentications',
  'class' => 'FastlyMutualAuthenticationListMutualAuthentications',
  'api_class' => 'MutualAuthenticationApi',
  'method_name' => 'listMutualAuthentications',
  'method' => 'GET',
  'path' => '/tls/mutual_authentications',
  'hosts' =>
  array (
    0 => 'https://api.fastly.com',
  ),
  'operation_host' => 'https://api.fastly.com',
  'name' => 'List Mutual Authentications',
  'description' => 'List Mutual Authentications',
  'type' => 'read',
  'parameters' =>
  array (
    'include' =>
    array (
      'type' => 'string',
      'required' => false,
      'description' => 'Fastly API parameter `include`.',
    ),
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
    'include' => 'include',
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
