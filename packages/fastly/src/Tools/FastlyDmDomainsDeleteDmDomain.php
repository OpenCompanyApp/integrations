<?php

namespace OpenCompany\Integrations\Fastly\Tools;

/**
 * Delete a domain
 *
 * Maps to Fastly generated client operation DmDomainsApi::deleteDmDomain (DELETE /domain-management/v1/domains/{domain_id}).
 */
class FastlyDmDomainsDeleteDmDomain extends AbstractFastlyTool
{
    protected const NAME = 'fastly_dm_domains_delete_dm_domain';
    protected const DESCRIPTION = 'Delete a domain

Official Fastly client operation: DmDomainsApi::deleteDmDomain
Endpoint: DELETE /domain-management/v1/domains/{domain_id}

Delete a domain';
    protected const PARAMETERS = array (
  'domain_id' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Fastly API parameter `domain_id`.',
  ),
);
    protected const OPERATION = array (
  'slug' => 'fastly_dm_domains_delete_dm_domain',
  'class' => 'FastlyDmDomainsDeleteDmDomain',
  'api_class' => 'DmDomainsApi',
  'method_name' => 'deleteDmDomain',
  'method' => 'DELETE',
  'path' => '/domain-management/v1/domains/{domain_id}',
  'hosts' =>
  array (
    0 => 'https://api.fastly.com',
  ),
  'operation_host' => 'https://api.fastly.com',
  'name' => 'Delete a domain',
  'description' => 'Delete a domain',
  'type' => 'write',
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
