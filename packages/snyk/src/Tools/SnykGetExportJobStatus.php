<?php

namespace OpenCompany\Integrations\Snyk\Tools;

/**
 * Get export status.
 *
 * Maps to the official Snyk endpoint get /orgs/{org_id}/jobs/export/{export_id}.
 */
class SnykGetExportJobStatus extends AbstractSnykTool
{
    protected const NAME = 'snyk_get_export_job_status';
    protected const DESCRIPTION = 'Get export status

Official Snyk endpoint: GET /orgs/{org_id}/jobs/export/{export_id}

Get an export job status #### Required permissions - `View Organization reports (org.report.read)`';
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
  'export_id' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `export_id` from the official Snyk API operation. Unique export identifier',
  ),
);
    protected const METHOD = 'get';
    protected const PATH = '/orgs/{org_id}/jobs/export/{export_id}';
    protected const PATH_PARAMS = array (
  'org_id' => 'org_id',
  'export_id' => 'export_id',
);
    protected const QUERY_PARAMS = array (
  'version' => 'version',
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}
