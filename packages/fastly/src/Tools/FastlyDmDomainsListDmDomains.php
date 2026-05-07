<?php

namespace OpenCompany\Integrations\Fastly\Tools;

/**
 * List domains
 *
 * Maps to Fastly generated client operation DmDomainsApi::listDmDomains (GET /domain-management/v1/domains).
 */
class FastlyDmDomainsListDmDomains extends AbstractFastlyTool
{
    protected const NAME = 'fastly_dm_domains_list_dm_domains';
    protected const DESCRIPTION = 'List domains

Official Fastly client operation: DmDomainsApi::listDmDomains
Endpoint: GET /domain-management/v1/domains

List domains';
    protected const PARAMETERS = array (
  'fqdn' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Fastly API parameter `fqdn`.',
  ),
  'fqdn_match' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Fastly API parameter `fqdn_match`.',
  ),
  'service_id' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Fastly API parameter `service_id`.',
  ),
  'sort' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Fastly API parameter `sort`.',
  ),
  'activated' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Fastly API parameter `activated`.',
  ),
  'verified' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Fastly API parameter `verified`.',
  ),
  'cursor' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Fastly API parameter `cursor`.',
  ),
  'limit' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Fastly API parameter `limit`.',
  ),
);
    protected const OPERATION = array (
  'slug' => 'fastly_dm_domains_list_dm_domains',
  'class' => 'FastlyDmDomainsListDmDomains',
  'api_class' => 'DmDomainsApi',
  'method_name' => 'listDmDomains',
  'method' => 'GET',
  'path' => '/domain-management/v1/domains',
  'hosts' =>
  array (
    0 => 'https://api.fastly.com',
  ),
  'operation_host' => 'https://api.fastly.com',
  'name' => 'List domains',
  'description' => 'List domains',
  'type' => 'read',
  'parameters' =>
  array (
    'fqdn' =>
    array (
      'type' => 'string',
      'required' => false,
      'description' => 'Fastly API parameter `fqdn`.',
    ),
    'fqdn_match' =>
    array (
      'type' => 'string',
      'required' => false,
      'description' => 'Fastly API parameter `fqdn_match`.',
    ),
    'service_id' =>
    array (
      'type' => 'string',
      'required' => false,
      'description' => 'Fastly API parameter `service_id`.',
    ),
    'sort' =>
    array (
      'type' => 'string',
      'required' => false,
      'description' => 'Fastly API parameter `sort`.',
    ),
    'activated' =>
    array (
      'type' => 'string',
      'required' => false,
      'description' => 'Fastly API parameter `activated`.',
    ),
    'verified' =>
    array (
      'type' => 'string',
      'required' => false,
      'description' => 'Fastly API parameter `verified`.',
    ),
    'cursor' =>
    array (
      'type' => 'string',
      'required' => false,
      'description' => 'Fastly API parameter `cursor`.',
    ),
    'limit' =>
    array (
      'type' => 'string',
      'required' => false,
      'description' => 'Fastly API parameter `limit`.',
    ),
  ),
  'path_params' =>
  array (
  ),
  'query_params' =>
  array (
    'fqdn' => 'fqdn',
    'fqdn_match' => 'fqdn_match',
    'service_id' => 'service_id',
    'sort' => 'sort',
    'activated' => 'activated',
    'verified' => 'verified',
    'cursor' => 'cursor',
    'limit' => 'limit',
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
