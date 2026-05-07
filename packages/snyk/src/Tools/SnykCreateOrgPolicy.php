<?php

namespace OpenCompany\Integrations\Snyk\Tools;

/**
 * Create a new org-level policy.
 *
 * Maps to the official Snyk endpoint post /orgs/{org_id}/policies.
 */
class SnykCreateOrgPolicy extends AbstractSnykTool
{
    protected const NAME = 'snyk_create_org_policy';
    protected const DESCRIPTION = 'Create a new org-level policy

Official Snyk endpoint: POST /orgs/{org_id}/policies

Create a new org-level policy. *Org level Policy APIs Access Notice:* Org level Policy APIs are only available for use with Code Consistent Ignores. For information about how to enable Code Consistent Ignores see [this](https://docs.snyk.io/manage-risk/prioritize-issues-for-fixing/ignore-issues/consistent-ignores-for-snyk-code#enable-snyk-code-consistent-ignores) documentation. #### Required permissions - `Create Ignores (org.project.ignore.create)`';
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
  'body' =>
  array (
    'type' => 'object',
    'required' => false,
    'description' => 'JSON request body matching the official Snyk API request schema.',
  ),
);
    protected const METHOD = 'post';
    protected const PATH = '/orgs/{org_id}/policies';
    protected const PATH_PARAMS = array (
  'org_id' => 'org_id',
);
    protected const QUERY_PARAMS = array (
  'version' => 'version',
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}
