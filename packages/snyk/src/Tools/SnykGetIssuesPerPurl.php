<?php

namespace OpenCompany\Integrations\Snyk\Tools;

/**
 * List issues for a package.
 *
 * Maps to the official Snyk endpoint get /orgs/{org_id}/packages/{purl}/issues.
 */
class SnykGetIssuesPerPurl extends AbstractSnykTool
{
    protected const NAME = 'snyk_get_issues_per_purl';
    protected const DESCRIPTION = 'List issues for a package

Official Snyk endpoint: GET /orgs/{org_id}/packages/{purl}/issues

Query issues for a specific package version identified by Package URL (purl). Snyk returns only direct vulnerabilities. Transitive vulnerabilities (from dependencies) are not returned because they can vary depending on context. For Maven packages, you can optionally include a checksum qualifier in the PURL to request checksum validation. The response will include metadata indicating whether the provided checksum matches Snyk\'s records. Vulnerabilities are always returned regardless of checksum match status; the validation metadata allows clients to interpret results appropriately. #### Required permissions - `View Organization (org.read)`';
    protected const PARAMETERS = array (
  'version' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Query parameter `version` from the official Snyk API operation. The requested version of the endpoint to process the request',
  ),
  'purl' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `purl` from the official Snyk API operation. A URI-encoded Package URL (purl). Supported purl types are apk, cargo, cocoapods, composer, conan, deb, gem, generic, golang, hex, maven,...',
  ),
  'org_id' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `org_id` from the official Snyk API operation. Unique identifier for an organization',
  ),
  'offset' =>
  array (
    'type' => 'integer',
    'required' => false,
    'description' => 'Query parameter `offset` from the official Snyk API operation. Specify the number of results to skip before returning results. Must be greater than or equal to 0. Default is 0.',
  ),
  'limit' =>
  array (
    'type' => 'integer',
    'required' => false,
    'description' => 'Query parameter `limit` from the official Snyk API operation. Specify the number of results to return. Must be greater than 0 and less than 1000. Default is 1000.',
  ),
);
    protected const METHOD = 'get';
    protected const PATH = '/orgs/{org_id}/packages/{purl}/issues';
    protected const PATH_PARAMS = array (
  'purl' => 'purl',
  'org_id' => 'org_id',
);
    protected const QUERY_PARAMS = array (
  'version' => 'version',
  'offset' => 'offset',
  'limit' => 'limit',
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}
