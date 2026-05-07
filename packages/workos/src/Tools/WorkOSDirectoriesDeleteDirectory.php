<?php

namespace OpenCompany\Integrations\WorkOS\Tools;

/**
 * Delete a Directory.
 *
 * Maps to the official WorkOS endpoint delete /directories/{id}.
 */
class WorkOSDirectoriesDeleteDirectory extends AbstractWorkOSTool
{
    protected const NAME = 'workos_directories_delete_directory';
    protected const DESCRIPTION = 'Delete a Directory

Official WorkOS endpoint: DELETE /directories/{id}

Permanently deletes an existing directory. It cannot be undone.';
    protected const PARAMETERS = array (
  'id' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `id` from the official WorkOS API operation.',
  ),
);
    protected const METHOD = 'delete';
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
