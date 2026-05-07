<?php

namespace OpenCompany\Integrations\WorkOS\Tools;

/**
 * List Directories.
 *
 * Maps to the official WorkOS endpoint get /directories.
 */
class WorkOSDirectoriesList extends AbstractWorkOSTool
{
    protected const NAME = 'workos_directories_list';
    protected const DESCRIPTION = 'List Directories

Official WorkOS endpoint: GET /directories

Get a list of all of your existing directories matching the criteria specified.';
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
  'organization_id' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Query parameter `organization_id` from the official WorkOS API operation.',
  ),
  'search' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Query parameter `search` from the official WorkOS API operation.',
  ),
  'domain' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Query parameter `domain` from the official WorkOS API operation.',
  ),
);
    protected const METHOD = 'get';
    protected const PATH = '/directories';
    protected const PATH_PARAMS = array (
);
    protected const QUERY_PARAMS = array (
  'before' => 'before',
  'after' => 'after',
  'limit' => 'limit',
  'order' => 'order',
  'organization_id' => 'organization_id',
  'search' => 'search',
  'domain' => 'domain',
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}
