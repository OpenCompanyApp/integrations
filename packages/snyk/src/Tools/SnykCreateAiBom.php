<?php

namespace OpenCompany\Integrations\Snyk\Tools;

/**
 * Create a new AI-BOM (Early Access).
 *
 * Maps to the official Snyk endpoint post /orgs/{org_id}/ai_boms.
 */
class SnykCreateAiBom extends AbstractSnykTool
{
    protected const NAME = 'snyk_create_ai_bom';
    protected const DESCRIPTION = 'Create a new AI-BOM (Early Access)

Official Snyk endpoint: POST /orgs/{org_id}/ai_boms

Triggers the creation of a new AI-BOM. The AI-BOM will be created in a background job. Users should query the background job status by using the getAiBomJob endpoint (/orgs/{org_id}/ai_bom_jobs/{job_id}). The response will contain a content-location header pointing to the getAiBomJob endpoint. #### Required permissions - `View Organization (org.read)`';
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
    protected const PATH = '/orgs/{org_id}/ai_boms';
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
