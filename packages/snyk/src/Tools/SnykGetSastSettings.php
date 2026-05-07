<?php

namespace OpenCompany\Integrations\Snyk\Tools;

/**
 * Retrieves the SAST settings for an org.
 *
 * Maps to the official Snyk endpoint get /orgs/{org_id}/settings/sast.
 */
class SnykGetSastSettings extends AbstractSnykTool
{
    protected const NAME = 'snyk_get_sast_settings';
    protected const DESCRIPTION = 'Retrieves the SAST settings for an org

Official Snyk endpoint: GET /orgs/{org_id}/settings/sast

Retrieves the SAST settings for an org #### Required permissions - `View Organization (org.read)`';
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
    'description' => 'Path parameter `org_id` from the official Snyk API operation. The id of the org for which we want to retrieve the SAST settings',
  ),
);
    protected const METHOD = 'get';
    protected const PATH = '/orgs/{org_id}/settings/sast';
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
