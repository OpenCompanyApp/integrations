<?php

namespace OpenCompany\Integrations\WorkOS\Tools;

/**
 * Create a Connect Application.
 *
 * Maps to the official WorkOS endpoint post /connect/applications.
 */
class WorkOSApplicationsCreate extends AbstractWorkOSTool
{
    protected const NAME = 'workos_applications_create';
    protected const DESCRIPTION = 'Create a Connect Application

Official WorkOS endpoint: POST /connect/applications

Create a new Connect Application. Supports both OAuth and Machine-to-Machine (M2M) application types.';
    protected const PARAMETERS = array (
  'body' =>
  array (
    'type' => 'object',
    'required' => true,
    'description' => 'JSON request body matching the official WorkOS OpenAPI request schema for this operation.',
  ),
);
    protected const METHOD = 'post';
    protected const PATH = '/connect/applications';
    protected const PATH_PARAMS = array (
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = true;
}
