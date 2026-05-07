<?php

namespace OpenCompany\Integrations\Snyk\Tools;

/**
 * List issues for a given set of packages (Currently not available to all customers).
 *
 * Maps to the official Snyk endpoint post /orgs/{org_id}/packages/issues.
 */
class SnykListIssuesForManyPurls extends AbstractSnykTool
{
    protected const NAME = 'snyk_list_issues_for_many_purls';
    protected const DESCRIPTION = 'List issues for a given set of packages  (Currently not available to all customers)

Official Snyk endpoint: POST /orgs/{org_id}/packages/issues

This endpoint is currently restricted and is not available to all customers. Query issues for a batch of packages identified by Package URL (purl). Only direct vulnerabilities are returned; transitive vulnerabilities (from dependencies) are not included as they can vary depending on the context. #### Required permissions - `View Organization (org.read)`';
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
    'description' => 'Path parameter `org_id` from the official Snyk API operation. Unique identifier for an organization',
  ),
  'body' =>
  array (
    'type' => 'object',
    'required' => true,
    'description' => 'JSON request body matching the official Snyk API request schema.',
  ),
);
    protected const METHOD = 'post';
    protected const PATH = '/orgs/{org_id}/packages/issues';
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
