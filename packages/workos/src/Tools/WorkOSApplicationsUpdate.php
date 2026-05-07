<?php

namespace OpenCompany\Integrations\WorkOS\Tools;

/**
 * Update a Connect Application.
 *
 * Maps to the official WorkOS endpoint put /connect/applications/{id}.
 */
class WorkOSApplicationsUpdate extends AbstractWorkOSTool
{
    protected const NAME = 'workos_applications_update';
    protected const DESCRIPTION = 'Update a Connect Application

Official WorkOS endpoint: PUT /connect/applications/{id}

Update an existing Connect Application. For OAuth applications, you can update redirect URIs. For all applications, you can update the name, description, and scopes.';
    protected const PARAMETERS = array (
  'id' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `id` from the official WorkOS API operation.',
  ),
  'body' =>
  array (
    'type' => 'object',
    'required' => true,
    'description' => 'JSON request body matching the official WorkOS OpenAPI request schema for this operation.',
  ),
);
    protected const METHOD = 'put';
    protected const PATH = '/connect/applications/{id}';
    protected const PATH_PARAMS = array (
  'id' => 'id',
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = true;
}
