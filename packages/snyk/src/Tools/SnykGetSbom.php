<?php

namespace OpenCompany\Integrations\Snyk\Tools;

/**
 * Get a project's SBOM document.
 *
 * Maps to the official Snyk endpoint get /orgs/{org_id}/projects/{project_id}/sbom.
 */
class SnykGetSbom extends AbstractSnykTool
{
    protected const NAME = 'snyk_get_sbom';
    protected const DESCRIPTION = 'Get a project’s SBOM document

Official Snyk endpoint: GET /orgs/{org_id}/projects/{project_id}/sbom

This endpoint lets you retrieve the SBOM document of a software project. It supports the following formats: * CycloneDX version 1.6 in JSON (set `format` to `cyclonedx1.6+json`). * CycloneDX version 1.6 in XML (set `format` to `cyclonedx1.6+xml`). * CycloneDX version 1.5 in JSON (set `format` to `cyclonedx1.5+json`). * CycloneDX version 1.5 in XML (set `format` to `cyclonedx1.5+xml`). * CycloneDX version 1.4 in JSON (set `format` to `cyclonedx1.4+json`). * CycloneDX version 1.4 in XML (set `format` to `cyclonedx1.4+xml`). * SPDX version 2.3 in JSON (set `format` to `spdx2.3+json`). By default it will respond with an empty JSON:API response. #### Required permissions - `View Project history (org.project.snapshot.read)`';
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
  'project_id' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `project_id` from the official Snyk API operation. Unique identifier for a project',
  ),
  'format' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Query parameter `format` from the official Snyk API operation. The desired SBOM format of the response.',
    'enum' =>
    array (
      0 => 'cyclonedx1.6+json',
      1 => 'cyclonedx1.6+xml',
      2 => 'cyclonedx1.5+json',
      3 => 'cyclonedx1.5+xml',
      4 => 'cyclonedx1.4+json',
      5 => 'cyclonedx1.4+xml',
      6 => 'spdx2.3+json',
    ),
  ),
  'exclude' =>
  array (
    'type' => 'array',
    'required' => false,
    'description' => 'Query parameter `exclude` from the official Snyk API operation. An array of features to be excluded from the generated SBOM.',
  ),
  'go_module_level' =>
  array (
    'type' => 'boolean',
    'required' => false,
    'description' => 'Query parameter `go_module_level` from the official Snyk API operation. When true, consolidate Go package-level dependencies into module-level components in the SBOM. Only applies to gomodules graphs; default ...',
  ),
);
    protected const METHOD = 'get';
    protected const PATH = '/orgs/{org_id}/projects/{project_id}/sbom';
    protected const PATH_PARAMS = array (
  'org_id' => 'org_id',
  'project_id' => 'project_id',
);
    protected const QUERY_PARAMS = array (
  'version' => 'version',
  'format' => 'format',
  'exclude' => 'exclude',
  'go_module_level' => 'go_module_level',
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}
