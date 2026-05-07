<?php

namespace OpenCompany\Integrations\WorkOS\Tools;

/**
 * Check authorization.
 *
 * Maps to the official WorkOS endpoint post /authorization/organization_memberships/{organization_membership_id}/check.
 */
class WorkOSAuthorizationCheck extends AbstractWorkOSTool
{
    protected const NAME = 'workos_authorization_check';
    protected const DESCRIPTION = 'Check authorization

Official WorkOS endpoint: POST /authorization/organization_memberships/{organization_membership_id}/check

Check if an organization membership has a specific permission on a resource. Supports identification by resource_id OR by resource_external_id + resource_type_slug.';
    protected const PARAMETERS = array (
  'organization_membership_id' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `organization_membership_id` from the official WorkOS API operation.',
  ),
  'body' =>
  array (
    'type' => 'object',
    'required' => true,
    'description' => 'JSON request body matching the official WorkOS OpenAPI request schema for this operation.',
  ),
);
    protected const METHOD = 'post';
    protected const PATH = '/authorization/organization_memberships/{organization_membership_id}/check';
    protected const PATH_PARAMS = array (
  'organization_membership_id' => 'organization_membership_id',
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = true;
}
