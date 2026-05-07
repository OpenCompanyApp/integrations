<?php

namespace OpenCompany\Integrations\Snyk\Tools;

/**
 * Get the Open Source Settings for an Org. (Early Access).
 *
 * Maps to the official Snyk endpoint get /orgs/{org_id}/settings/opensource.
 */
class SnykGetOpenSourceSettingsForOrg extends AbstractSnykTool
{
    protected const NAME = 'snyk_get_open_source_settings_for_org';
    protected const DESCRIPTION = 'Get the Open Source Settings for an Org. (Early Access)

Official Snyk endpoint: GET /orgs/{org_id}/settings/opensource

Returns settings for your Org which may also be controlled at the Group level. #### Required permissions - `View Organization (org.read)`';
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
    'description' => 'Path parameter `org_id` from the official Snyk API operation. The id of the org.',
  ),
);
    protected const METHOD = 'get';
    protected const PATH = '/orgs/{org_id}/settings/opensource';
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
