<?php

namespace OpenCompany\Integrations\WorkOS\Tools;

/**
 * Create an authorization resource.
 *
 * Maps to the official WorkOS endpoint post /authorization/resources.
 */
class WorkOSAuthorizationResourcesCreate extends AbstractWorkOSTool
{
    protected const NAME = 'workos_authorization_resources_create';
    protected const DESCRIPTION = 'Create an authorization resource

Official WorkOS endpoint: POST /authorization/resources

Create a new authorization resource.';
    protected const PARAMETERS = array (
  'body' =>
  array (
    'type' => 'object',
    'required' => true,
    'description' => 'JSON request body matching the official WorkOS OpenAPI request schema for this operation.',
  ),
);
    protected const METHOD = 'post';
    protected const PATH = '/authorization/resources';
    protected const PATH_PARAMS = array (
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = true;
}
