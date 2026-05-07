<?php

namespace OpenCompany\Integrations\WorkOS\Tools;

/**
 * Get a Directory User.
 *
 * Maps to the official WorkOS endpoint get /directory_users/{id}.
 */
class WorkOSDirectoryUsersFind extends AbstractWorkOSTool
{
    protected const NAME = 'workos_directory_users_find';
    protected const DESCRIPTION = 'Get a Directory User

Official WorkOS endpoint: GET /directory_users/{id}

Get the details of an existing Directory User.';
    protected const PARAMETERS = array (
  'id' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `id` from the official WorkOS API operation.',
  ),
);
    protected const METHOD = 'get';
    protected const PATH = '/directory_users/{id}';
    protected const PATH_PARAMS = array (
  'id' => 'id',
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}
