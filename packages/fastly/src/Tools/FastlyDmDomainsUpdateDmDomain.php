<?php

namespace OpenCompany\Integrations\Fastly\Tools;

/**
 * Update a domain
 *
 * Maps to Fastly generated client operation DmDomainsApi::updateDmDomain (PATCH /domain-management/v1/domains/{domain_id}).
 */
class FastlyDmDomainsUpdateDmDomain extends AbstractFastlyTool
{
    protected const NAME = 'fastly_dm_domains_update_dm_domain';
    protected const DESCRIPTION = 'Update a domain

Official Fastly client operation: DmDomainsApi::updateDmDomain
Endpoint: PATCH /domain-management/v1/domains/{domain_id}

Update a domain';
    protected const PARAMETERS = array (
  'domain_id' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Fastly API parameter `domain_id`.',
  ),
  'request_body_for_update' =>
  array (
    'type' => 'object',
    'required' => false,
    'description' => 'JSON request body matching the Fastly generated client parameter `request_body_for_update`.',
  ),
  'body' =>
  array (
    'type' => 'object',
    'required' => false,
    'description' => 'Alias for the JSON request body.',
  ),
);
    protected const OPERATION = array (
  'slug' => 'fastly_dm_domains_update_dm_domain',
  'class' => 'FastlyDmDomainsUpdateDmDomain',
  'api_class' => 'DmDomainsApi',
  'method_name' => 'updateDmDomain',
  'method' => 'PATCH',
  'path' => '/domain-management/v1/domains/{domain_id}',
  'hosts' =>
  array (
    0 => 'https://api.fastly.com',
  ),
  'operation_host' => 'https://api.fastly.com',
  'name' => 'Update a domain',
  'description' => 'Update a domain',
  'type' => 'write',
  'parameters' =>
  array (
    'domain_id' =>
    array (
      'type' => 'string',
      'required' => true,
      'description' => 'Fastly API parameter `domain_id`.',
    ),
    'request_body_for_update' =>
    array (
      'type' => 'object',
      'required' => false,
      'description' => 'JSON request body matching the Fastly generated client parameter `request_body_for_update`.',
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
  'body_param' => 'request_body_for_update',
  'body_required' => false,
);
}
