<?php

namespace OpenCompany\Integrations\WorkOS\Tools;

/**
 * List Client Secrets for a Connect Application.
 *
 * Maps to the official WorkOS endpoint get /connect/applications/{id}/client_secrets.
 */
class WorkOSApplicationCredentialsList extends AbstractWorkOSTool
{
    protected const NAME = 'workos_application_credentials_list';
    protected const DESCRIPTION = 'List Client Secrets for a Connect Application

Official WorkOS endpoint: GET /connect/applications/{id}/client_secrets

List all client secrets associated with a Connect Application.';
    protected const PARAMETERS = array (
  'id' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `id` from the official WorkOS API operation.',
  ),
);
    protected const METHOD = 'get';
    protected const PATH = '/connect/applications/{id}/client_secrets';
    protected const PATH_PARAMS = array (
  'id' => 'id',
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}
