<?php

namespace OpenCompany\Integrations\Snyk\Tools;

/**
 * Get an issue.
 *
 * Maps to the official Snyk endpoint get /orgs/{org_id}/issues/{issue_id}.
 */
class SnykGetOrgIssueByIssueID extends AbstractSnykTool
{
    protected const NAME = 'snyk_get_org_issue_by_issue_id';
    protected const DESCRIPTION = 'Get an issue

Official Snyk endpoint: GET /orgs/{org_id}/issues/{issue_id}

Get an issue #### Required permissions - `View Organization (org.read)` - `View Projects (org.project.read)` - `View Project history (org.project.snapshot.read)`';
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
  'issue_id' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `issue_id` from the official Snyk API operation. Issue ID',
  ),
);
    protected const METHOD = 'get';
    protected const PATH = '/orgs/{org_id}/issues/{issue_id}';
    protected const PATH_PARAMS = array (
  'org_id' => 'org_id',
  'issue_id' => 'issue_id',
);
    protected const QUERY_PARAMS = array (
  'version' => 'version',
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}
