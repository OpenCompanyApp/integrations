<?php

namespace OpenCompany\Integrations\WorkOS\Tools;

/**
 * List Directory Users.
 *
 * Maps to the official WorkOS endpoint get /directory_users.
 */
class WorkOSDirectoryUsersList extends AbstractWorkOSTool
{
    protected const NAME = 'workos_directory_users_list';
    protected const DESCRIPTION = 'List Directory Users

Official WorkOS endpoint: GET /directory_users

Get a list of all of existing Directory Users matching the criteria specified.';
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
  'group' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Query parameter `group` from the official WorkOS API operation.',
  ),
);
    protected const METHOD = 'get';
    protected const PATH = '/directory_users';
    protected const PATH_PARAMS = array (
);
    protected const QUERY_PARAMS = array (
  'before' => 'before',
  'after' => 'after',
  'limit' => 'limit',
  'order' => 'order',
  'directory' => 'directory',
  'group' => 'group',
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}
