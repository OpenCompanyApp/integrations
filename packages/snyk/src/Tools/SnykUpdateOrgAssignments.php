<?php

namespace OpenCompany\Integrations\Snyk\Tools;

/**
 * Update due date for assignments in an organization. (Early Access).
 *
 * Maps to the official Snyk endpoint patch /orgs/{org_id}/learn/assignments.
 */
class SnykUpdateOrgAssignments extends AbstractSnykTool
{
    protected const NAME = 'snyk_update_org_assignments';
    protected const DESCRIPTION = 'Update due date for assignments in an organization. (Early Access)

Official Snyk endpoint: PATCH /orgs/{org_id}/learn/assignments

Allows an admin to update the due date for existing assignments within their organization. #### Required permissions - `Edit assignments (org.learn_assignment.edit)`';
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
    protected const METHOD = 'patch';
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
