<?php

namespace OpenCompany\Integrations\Snyk\Tools;

/**
 * Start an export.
 *
 * Maps to the official Snyk endpoint post /orgs/{org_id}/export.
 */
class SnykCreateExport extends AbstractSnykTool
{
    protected const NAME = 'snyk_create_export';
    protected const DESCRIPTION = 'Start an export

Official Snyk endpoint: POST /orgs/{org_id}/export

Create and start an export for an org #### Required permissions - `View Organization reports (org.report.read)`';
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
  'include_deleted' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Query parameter `include_deleted` from the official Snyk API operation. Optional parameter to include deleted issues in results',
  ),
  'include_deactivated' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Query parameter `include_deactivated` from the official Snyk API operation. Optional parameter to include disabled issues in results',
  ),
  'body' =>
  array (
    'type' => 'object',
    'required' => false,
    'description' => 'JSON request body matching the official Snyk API request schema.',
  ),
);
    protected const METHOD = 'post';
    protected const PATH = '/orgs/{org_id}/export';
    protected const PATH_PARAMS = array (
  'org_id' => 'org_id',
);
    protected const QUERY_PARAMS = array (
  'version' => 'version',
  'include_deleted' => 'include_deleted',
  'include_deactivated' => 'include_deactivated',
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}
