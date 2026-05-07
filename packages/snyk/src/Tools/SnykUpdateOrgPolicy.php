<?php

namespace OpenCompany\Integrations\Snyk\Tools;

/**
 * Update an org-level policy.
 *
 * Maps to the official Snyk endpoint patch /orgs/{org_id}/policies/{policy_id}.
 */
class SnykUpdateOrgPolicy extends AbstractSnykTool
{
    protected const NAME = 'snyk_update_org_policy';
    protected const DESCRIPTION = 'Update an org-level policy

Official Snyk endpoint: PATCH /orgs/{org_id}/policies/{policy_id}

Update the org-level policy. *Org level Policy APIs Access Notice:* Org level Policy APIs are only available for use with Code Consistent Ignores. For information about how to enable Code Consistent Ignores see [this](https://docs.snyk.io/manage-risk/prioritize-issues-for-fixing/ignore-issues/consistent-ignores-for-snyk-code#enable-snyk-code-consistent-ignores) documentation. #### Required permissions - `Edit Ignores (org.project.ignore.edit)`';
    protected const PARAMETERS = array (
  'version' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Query parameter `version` from the official Snyk API operation. The requested version of the endpoint to process the request',
  ),
  'org_id' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `org_id` from the official Snyk API operation. Org ID',
  ),
  'policy_id' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `policy_id` from the official Snyk API operation. Policy ID',
  ),
  'body' =>
  array (
    'type' => 'object',
    'required' => false,
    'description' => 'JSON request body matching the official Snyk API request schema.',
  ),
);
    protected const METHOD = 'patch';
    protected const PATH = '/orgs/{org_id}/policies/{policy_id}';
    protected const PATH_PARAMS = array (
  'org_id' => 'org_id',
  'policy_id' => 'policy_id',
);
    protected const QUERY_PARAMS = array (
  'version' => 'version',
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}
