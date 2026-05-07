<?php

namespace OpenCompany\Integrations\WorkOS\Tools;

/**
 * Delete a Client Secret.
 *
 * Maps to the official WorkOS endpoint delete /connect/client_secrets/{id}.
 */
class WorkOSApplicationCredentialsDelete extends AbstractWorkOSTool
{
    protected const NAME = 'workos_application_credentials_delete';
    protected const DESCRIPTION = 'Delete a Client Secret

Official WorkOS endpoint: DELETE /connect/client_secrets/{id}

Delete (revoke) an existing client secret.';
    protected const PARAMETERS = array (
  'id' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `id` from the official WorkOS API operation.',
  ),
);
    protected const METHOD = 'delete';
    protected const PATH = '/connect/client_secrets/{id}';
    protected const PATH_PARAMS = array (
  'id' => 'id',
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}
