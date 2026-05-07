<?php

namespace OpenCompany\Integrations\WorkOS\Tools;

/**
 * Delete a Connection.
 *
 * Maps to the official WorkOS endpoint delete /connections/{id}.
 */
class WorkOSConnectionsDelete extends AbstractWorkOSTool
{
    protected const NAME = 'workos_connections_delete';
    protected const DESCRIPTION = 'Delete a Connection

Official WorkOS endpoint: DELETE /connections/{id}

Permanently deletes an existing connection. It cannot be undone.';
    protected const PARAMETERS = array (
  'id' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `id` from the official WorkOS API operation.',
  ),
);
    protected const METHOD = 'delete';
    protected const PATH = '/connections/{id}';
    protected const PATH_PARAMS = array (
  'id' => 'id',
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}
