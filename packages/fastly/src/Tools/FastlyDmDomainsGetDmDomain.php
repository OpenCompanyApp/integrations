<?php

namespace OpenCompany\Integrations\Fastly\Tools;

/**
 * Get a domain
 *
 * Maps to Fastly generated client operation DmDomainsApi::getDmDomain (GET /domain-management/v1/domains/{domain_id}).
 */
class FastlyDmDomainsGetDmDomain extends AbstractFastlyTool
{
    protected const NAME = 'fastly_dm_domains_get_dm_domain';
    protected const DESCRIPTION = 'Get a domain

Official Fastly client operation: DmDomainsApi::getDmDomain
Endpoint: GET /domain-management/v1/domains/{domain_id}

Get a domain';
    protected const PARAMETERS = array (
  'domain_id' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Fastly API parameter `domain_id`.',
  ),
);
    protected const OPERATION = array (
  'slug' => 'fastly_dm_domains_get_dm_domain',
  'class' => 'FastlyDmDomainsGetDmDomain',
  'api_class' => 'DmDomainsApi',
  'method_name' => 'getDmDomain',
  'method' => 'GET',
  'path' => '/domain-management/v1/domains/{domain_id}',
  'hosts' =>
  array (
    0 => 'https://api.fastly.com',
  ),
  'operation_host' => 'https://api.fastly.com',
  'name' => 'Get a domain',
  'description' => 'Get a domain',
  'type' => 'read',
  'parameters' =>
  array (
    'domain_id' =>
    array (
      'type' => 'string',
      'required' => true,
      'description' => 'Fastly API parameter `domain_id`.',
    ),
  ),
  'path_params' =>
  array (
    'domain_id' => 'domain_id',
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
