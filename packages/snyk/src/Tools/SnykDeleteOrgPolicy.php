<?php

namespace OpenCompany\Integrations\Snyk\Tools;

/**
 * Delete an org-level policy.
 *
 * Maps to the official Snyk endpoint delete /orgs/{org_id}/policies/{policy_id}.
 */
class SnykDeleteOrgPolicy extends AbstractSnykTool
{
    protected const NAME = 'snyk_delete_org_policy';
    protected const DESCRIPTION = 'Delete an org-level policy

Official Snyk endpoint: DELETE /orgs/{org_id}/policies/{policy_id}

Delete an existing org-level policy. *Org level Policy APIs Access Notice:* Org level Policy APIs are only available for use with Code Consistent Ignores. For information about how to enable Code Consistent Ignores see [this](https://docs.snyk.io/manage-risk/prioritize-issues-for-fixing/ignore-issues/consistent-ignores-for-snyk-code#enable-snyk-code-consistent-ignores) documentation. #### Required permissions - `Remove Ignores (org.project.ignore.delete)`';
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
);
    protected const METHOD = 'delete';
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
