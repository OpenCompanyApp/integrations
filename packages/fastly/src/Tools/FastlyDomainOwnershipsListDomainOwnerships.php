<?php

namespace OpenCompany\Integrations\Fastly\Tools;

/**
 * List domain-ownerships
 *
 * Maps to Fastly generated client operation DomainOwnershipsApi::listDomainOwnerships (GET /domain-ownerships).
 */
class FastlyDomainOwnershipsListDomainOwnerships extends AbstractFastlyTool
{
    protected const NAME = 'fastly_domain_ownerships_list_domain_ownerships';
    protected const DESCRIPTION = 'List domain-ownerships

Official Fastly client operation: DomainOwnershipsApi::listDomainOwnerships
Endpoint: GET /domain-ownerships

List domain-ownerships';
    protected const PARAMETERS = array (
);
    protected const OPERATION = array (
  'slug' => 'fastly_domain_ownerships_list_domain_ownerships',
  'class' => 'FastlyDomainOwnershipsListDomainOwnerships',
  'api_class' => 'DomainOwnershipsApi',
  'method_name' => 'listDomainOwnerships',
  'method' => 'GET',
  'path' => '/domain-ownerships',
  'hosts' =>
  array (
    0 => 'https://api.fastly.com',
  ),
  'operation_host' => 'https://api.fastly.com',
  'name' => 'List domain-ownerships',
  'description' => 'List domain-ownerships',
  'type' => 'read',
  'parameters' =>
  array (
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
  'body_param' => NULL,
  'body_required' => false,
);
}
