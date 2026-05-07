<?php

namespace OpenCompany\Integrations\WorkOS\Tools;

/**
 * Delete a Connect Application.
 *
 * Maps to the official WorkOS endpoint delete /connect/applications/{id}.
 */
class WorkOSApplicationsDelete extends AbstractWorkOSTool
{
    protected const NAME = 'workos_applications_delete';
    protected const DESCRIPTION = 'Delete a Connect Application

Official WorkOS endpoint: DELETE /connect/applications/{id}

Delete an existing Connect Application.';
    protected const PARAMETERS = array (
  'id' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `id` from the official WorkOS API operation.',
  ),
);
    protected const METHOD = 'delete';
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
