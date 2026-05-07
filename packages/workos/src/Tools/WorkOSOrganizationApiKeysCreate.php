<?php

namespace OpenCompany\Integrations\WorkOS\Tools;

/**
 * Create an API key for an organization.
 *
 * Maps to the official WorkOS endpoint post /organizations/{organizationId}/api_keys.
 */
class WorkOSOrganizationApiKeysCreate extends AbstractWorkOSTool
{
    protected const NAME = 'workos_organization_api_keys_create';
    protected const DESCRIPTION = 'Create an API key for an organization

Official WorkOS endpoint: POST /organizations/{organizationId}/api_keys

Create a new API key for an organization.';
    protected const PARAMETERS = array (
  'organization_id' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `organizationId` from the official WorkOS API operation.',
  ),
  'body' =>
  array (
    'type' => 'object',
    'required' => true,
    'description' => 'JSON request body matching the official WorkOS OpenAPI request schema for this operation.',
  ),
);
    protected const METHOD = 'post';
    protected const PATH = '/organizations/{organizationId}/api_keys';
    protected const PATH_PARAMS = array (
  'organizationId' => 'organization_id',
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = true;
}
