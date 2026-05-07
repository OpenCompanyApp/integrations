<?php

namespace OpenCompany\Integrations\WorkOS\Tools;

/**
 * List Directory Groups.
 *
 * Maps to the official WorkOS endpoint get /directory_groups.
 */
class WorkOSDirectoryGroupsList extends AbstractWorkOSTool
{
    protected const NAME = 'workos_directory_groups_list';
    protected const DESCRIPTION = 'List Directory Groups

Official WorkOS endpoint: GET /directory_groups

Get a list of all of existing directory groups matching the criteria specified.';
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
  'directory' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Query parameter `directory` from the official WorkOS API operation.',
  ),
  'user' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Query parameter `user` from the official WorkOS API operation.',
  ),
);
    protected const METHOD = 'get';
    protected const PATH = '/directory_groups';
    protected const PATH_PARAMS = array (
);
    protected const QUERY_PARAMS = array (
  'before' => 'before',
  'after' => 'after',
  'limit' => 'limit',
  'order' => 'order',
  'directory' => 'directory',
  'user' => 'user',
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}
