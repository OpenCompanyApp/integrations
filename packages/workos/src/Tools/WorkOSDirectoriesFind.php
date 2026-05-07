<?php

namespace OpenCompany\Integrations\WorkOS\Tools;

/**
 * Get a Directory.
 *
 * Maps to the official WorkOS endpoint get /directories/{id}.
 */
class WorkOSDirectoriesFind extends AbstractWorkOSTool
{
    protected const NAME = 'workos_directories_find';
    protected const DESCRIPTION = 'Get a Directory

Official WorkOS endpoint: GET /directories/{id}

Get the details of an existing directory.';
    protected const PARAMETERS = array (
  'id' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `id` from the official WorkOS API operation.',
  ),
);
    protected const METHOD = 'get';
    protected const PATH = '/directories/{id}';
    protected const PATH_PARAMS = array (
  'id' => 'id',
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}
