<?php

namespace OpenCompany\Integrations\Snyk\Tools;

/**
 * Get the Infrastructure as Code Settings for an org..
 *
 * Maps to the official Snyk endpoint get /orgs/{org_id}/settings/iac.
 */
class SnykGetIacSettingsForOrg extends AbstractSnykTool
{
    protected const NAME = 'snyk_get_iac_settings_for_org';
    protected const DESCRIPTION = 'Get the Infrastructure as Code Settings for an org.

Official Snyk endpoint: GET /orgs/{org_id}/settings/iac

Get the Infrastructure as Code Settings for an org. #### Required permissions - `View Organization (org.read)`';
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
    'description' => 'Path parameter `org_id` from the official Snyk API operation. The id of the org whose Infrastructure as Code settings are requested.',
  ),
);
    protected const METHOD = 'get';
    protected const PATH = '/orgs/{org_id}/settings/iac';
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
