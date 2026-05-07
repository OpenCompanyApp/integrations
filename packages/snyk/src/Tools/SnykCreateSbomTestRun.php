<?php

namespace OpenCompany\Integrations\Snyk\Tools;

/**
 * Create an SBOM test run (Early Access).
 *
 * Maps to the official Snyk endpoint post /orgs/{org_id}/sbom_tests.
 */
class SnykCreateSbomTestRun extends AbstractSnykTool
{
    protected const NAME = 'snyk_create_sbom_test_run';
    protected const DESCRIPTION = 'Create an SBOM test run (Early Access)

Official Snyk endpoint: POST /orgs/{org_id}/sbom_tests

Create an SBOM test run by supplying an SBOM document. The components contained in the given document will get analyzed for known vulnerabilities. In order for component identification to be successful, they must have a PackageURL (purl) of a supported purl type assigned. Analysis will be skipped for any component that does not fulfill this requirement. Supported SBOM formats: CycloneDX 1.4 JSON, CycloneDX 1.5 JSON, CycloneDX 1.6 JSON, SPDX 2.3 JSON Supported purl types: apk, cargo, cocoapods, composer, conan, deb, gem, generic, golang, hex, maven, npm, nuget, pub, pypi, rpm, swift #### Required permissions - `Test Projects (org.project.test)`';
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
    protected const PATH = '/orgs/{org_id}/sbom_tests';
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
