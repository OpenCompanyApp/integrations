<?php

namespace OpenCompany\Integrations\Snyk\Tools;

/**
 * Get an issue.
 *
 * Maps to the official Snyk endpoint get /groups/{group_id}/issues/{issue_id}.
 */
class SnykGetGroupIssueByIssueID extends AbstractSnykTool
{
    protected const NAME = 'snyk_get_group_issue_by_issue_id';
    protected const DESCRIPTION = 'Get an issue

Official Snyk endpoint: GET /groups/{group_id}/issues/{issue_id}

Get an issue #### Required permissions - `View Issues (group.issues.read)`';
    protected const PARAMETERS = array (
  'version' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Query parameter `version` from the official Snyk API operation. The requested version of the endpoint to process the request',
  ),
  'group_id' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `group_id` from the official Snyk API operation. Group ID',
  ),
  'issue_id' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `issue_id` from the official Snyk API operation. Issue ID',
  ),
);
    protected const METHOD = 'get';
    protected const PATH = '/groups/{group_id}/issues/{issue_id}';
    protected const PATH_PARAMS = array (
  'group_id' => 'group_id',
  'issue_id' => 'issue_id',
);
    protected const QUERY_PARAMS = array (
  'version' => 'version',
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}
