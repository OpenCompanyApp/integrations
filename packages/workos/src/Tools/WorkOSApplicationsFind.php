<?php

namespace OpenCompany\Integrations\WorkOS\Tools;

/**
 * Get a Connect Application.
 *
 * Maps to the official WorkOS endpoint get /connect/applications/{id}.
 */
class WorkOSApplicationsFind extends AbstractWorkOSTool
{
    protected const NAME = 'workos_applications_find';
    protected const DESCRIPTION = 'Get a Connect Application

Official WorkOS endpoint: GET /connect/applications/{id}

Retrieve details for a specific Connect Application by ID or client ID.';
    protected const PARAMETERS = array (
  'id' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `id` from the official WorkOS API operation.',
  ),
);
    protected const METHOD = 'get';
    protected const PATH = '/connect/applications/{id}';
    protected const PATH_PARAMS = array (
  'id' => 'id',
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}
