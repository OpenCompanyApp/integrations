<?php

namespace OpenCompany\Integrations\WorkOS\Tools;

/**
 * Create an Organization.
 *
 * Maps to the official WorkOS endpoint post /organizations.
 */
class WorkOSOrganizationsCreate extends AbstractWorkOSTool
{
    protected const NAME = 'workos_organizations_create';
    protected const DESCRIPTION = 'Create an Organization

Official WorkOS endpoint: POST /organizations

Creates a new organization in the current environment.';
    protected const PARAMETERS = array (
  'body' =>
  array (
    'type' => 'object',
    'required' => true,
    'description' => 'JSON request body matching the official WorkOS OpenAPI request schema for this operation.',
  ),
);
    protected const METHOD = 'post';
    protected const PATH = '/organizations';
    protected const PATH_PARAMS = array (
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = true;
}
