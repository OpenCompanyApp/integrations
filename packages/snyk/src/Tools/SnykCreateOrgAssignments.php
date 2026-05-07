<?php

namespace OpenCompany\Integrations\Snyk\Tools;

/**
 * Bulk creation of assignments for users in an organization. (Early Access).
 *
 * Maps to the official Snyk endpoint post /orgs/{org_id}/learn/assignments.
 */
class SnykCreateOrgAssignments extends AbstractSnykTool
{
    protected const NAME = 'snyk_create_org_assignments';
    protected const DESCRIPTION = 'Bulk creation of assignments for users in an organization. (Early Access)

Official Snyk endpoint: POST /orgs/{org_id}/learn/assignments

Allows an admin to create assignments in bulk for all or a subset of users within their organization. #### Required permissions - `Create assignments (org.learn_assignment.create)`';
    protected const PARAMETERS = array (
  'org_id' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `org_id` from the official Snyk API operation. The unique identifier of the organization.',
  ),
  'version' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Query parameter `version` from the official Snyk API operation. The requested version of the endpoint to process the request',
  ),
  'body' =>
  array (
    'type' => 'object',
    'required' => true,
    'description' => 'JSON request body matching the official Snyk API request schema.',
  ),
);
    protected const METHOD = 'post';
    protected const PATH = '/orgs/{org_id}/learn/assignments';
    protected const PATH_PARAMS = array (
  'org_id' => 'org_id',
);
    protected const QUERY_PARAMS = array (
  'version' => 'version',
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = true;
}
