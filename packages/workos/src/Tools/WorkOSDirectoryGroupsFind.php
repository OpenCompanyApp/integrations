<?php

namespace OpenCompany\Integrations\WorkOS\Tools;

/**
 * Get a Directory Group.
 *
 * Maps to the official WorkOS endpoint get /directory_groups/{id}.
 */
class WorkOSDirectoryGroupsFind extends AbstractWorkOSTool
{
    protected const NAME = 'workos_directory_groups_find';
    protected const DESCRIPTION = 'Get a Directory Group

Official WorkOS endpoint: GET /directory_groups/{id}

Get the details of an existing Directory Group.';
    protected const PARAMETERS = array (
  'id' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `id` from the official WorkOS API operation.',
  ),
);
    protected const METHOD = 'get';
    protected const PATH = '/directory_groups/{id}';
    protected const PATH_PARAMS = array (
  'id' => 'id',
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}
