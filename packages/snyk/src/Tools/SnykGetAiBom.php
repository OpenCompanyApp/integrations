<?php

namespace OpenCompany\Integrations\Snyk\Tools;

/**
 * Get an AI-BOM. (Early Access).
 *
 * Maps to the official Snyk endpoint get /orgs/{org_id}/ai_boms/{ai_bom_id}.
 */
class SnykGetAiBom extends AbstractSnykTool
{
    protected const NAME = 'snyk_get_ai_bom';
    protected const DESCRIPTION = 'Get an AI-BOM. (Early Access)

Official Snyk endpoint: GET /orgs/{org_id}/ai_boms/{ai_bom_id}

Get a AI-BOM once it\'s job has finished #### Required permissions - `View Organization (org.read)`';
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
  'ai_bom_id' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `ai_bom_id` from the official Snyk API operation. The ai_bom id',
  ),
);
    protected const METHOD = 'get';
    protected const PATH = '/orgs/{org_id}/ai_boms/{ai_bom_id}';
    protected const PATH_PARAMS = array (
  'org_id' => 'org_id',
  'ai_bom_id' => 'ai_bom_id',
);
    protected const QUERY_PARAMS = array (
  'version' => 'version',
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}
