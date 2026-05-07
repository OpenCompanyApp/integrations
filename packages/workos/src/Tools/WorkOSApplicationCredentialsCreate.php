<?php

namespace OpenCompany\Integrations\WorkOS\Tools;

/**
 * Create a new client secret for a Connect Application.
 *
 * Maps to the official WorkOS endpoint post /connect/applications/{id}/client_secrets.
 */
class WorkOSApplicationCredentialsCreate extends AbstractWorkOSTool
{
    protected const NAME = 'workos_application_credentials_create';
    protected const DESCRIPTION = 'Create a new client secret for a Connect Application

Official WorkOS endpoint: POST /connect/applications/{id}/client_secrets

Create new secrets for a Connect Application.';
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
    protected const METHOD = 'post';
    protected const PATH = '/connect/applications/{id}/client_secrets';
    protected const PATH_PARAMS = array (
  'id' => 'id',
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = true;
}
