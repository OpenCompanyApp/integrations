<?php

namespace OpenCompany\Integrations\WorkOS\Tools;

/**
 * Get a Connection.
 *
 * Maps to the official WorkOS endpoint get /connections/{id}.
 */
class WorkOSConnectionsFind extends AbstractWorkOSTool
{
    protected const NAME = 'workos_connections_find';
    protected const DESCRIPTION = 'Get a Connection

Official WorkOS endpoint: GET /connections/{id}

Get the details of an existing connection.';
    protected const PARAMETERS = array (
  'id' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `id` from the official WorkOS API operation.',
  ),
);
    protected const METHOD = 'get';
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
