<?php

namespace OpenCompany\Integrations\WorkOS\Tools;

/**
 * List Organizations.
 *
 * Maps to the official WorkOS endpoint get /organizations.
 */
class WorkOSOrganizationsList extends AbstractWorkOSTool
{
    protected const NAME = 'workos_organizations_list';
    protected const DESCRIPTION = 'List Organizations

Official WorkOS endpoint: GET /organizations

Get a list of all of your existing organizations matching the criteria specified.';
    protected const PARAMETERS = array (
  'before' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Query parameter `before` from the official WorkOS API operation.',
  ),
  'after' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Query parameter `after` from the official WorkOS API operation.',
  ),
  'limit' =>
  array (
    'type' => 'integer',
    'required' => false,
    'description' => 'Query parameter `limit` from the official WorkOS API operation.',
  ),
  'order' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Query parameter `order` from the official WorkOS API operation.',
  ),
  'domains' =>
  array (
    'type' => 'array',
    'required' => false,
    'description' => 'Query parameter `domains` from the official WorkOS API operation.',
  ),
  'search' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Query parameter `search` from the official WorkOS API operation.',
  ),
);
    protected const METHOD = 'get';
    protected const PATH = '/organizations';
    protected const PATH_PARAMS = array (
);
    protected const QUERY_PARAMS = array (
  'before' => 'before',
  'after' => 'after',
  'limit' => 'limit',
  'order' => 'order',
  'domains' => 'domains',
  'search' => 'search',
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}
