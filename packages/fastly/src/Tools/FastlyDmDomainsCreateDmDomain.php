<?php

namespace OpenCompany\Integrations\Fastly\Tools;

/**
 * Create a domain
 *
 * Maps to Fastly generated client operation DmDomainsApi::createDmDomain (POST /domain-management/v1/domains).
 */
class FastlyDmDomainsCreateDmDomain extends AbstractFastlyTool
{
    protected const NAME = 'fastly_dm_domains_create_dm_domain';
    protected const DESCRIPTION = 'Create a domain

Official Fastly client operation: DmDomainsApi::createDmDomain
Endpoint: POST /domain-management/v1/domains

Create a domain';
    protected const PARAMETERS = array (
  'request_body_for_create' =>
  array (
    'type' => 'object',
    'required' => false,
    'description' => 'JSON request body matching the Fastly generated client parameter `request_body_for_create`.',
  ),
  'body' =>
  array (
    'type' => 'object',
    'required' => false,
    'description' => 'Alias for the JSON request body.',
  ),
);
    protected const OPERATION = array (
  'slug' => 'fastly_dm_domains_create_dm_domain',
  'class' => 'FastlyDmDomainsCreateDmDomain',
  'api_class' => 'DmDomainsApi',
  'method_name' => 'createDmDomain',
  'method' => 'POST',
  'path' => '/domain-management/v1/domains',
  'hosts' =>
  array (
    0 => 'https://api.fastly.com',
  ),
  'operation_host' => 'https://api.fastly.com',
  'name' => 'Create a domain',
  'description' => 'Create a domain',
  'type' => 'write',
  'parameters' =>
  array (
    'request_body_for_create' =>
    array (
      'type' => 'object',
      'required' => false,
      'description' => 'JSON request body matching the Fastly generated client parameter `request_body_for_create`.',
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
  'body_param' => 'request_body_for_create',
  'body_required' => false,
);
}
