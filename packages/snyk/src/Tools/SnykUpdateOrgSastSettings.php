<?php

namespace OpenCompany\Integrations\Snyk\Tools;

/**
 * Enable/Disable the Snyk Code settings for an org.
 *
 * Maps to the official Snyk endpoint patch /orgs/{org_id}/settings/sast.
 */
class SnykUpdateOrgSastSettings extends AbstractSnykTool
{
    protected const NAME = 'snyk_update_org_sast_settings';
    protected const DESCRIPTION = 'Enable/Disable the Snyk Code settings for an org

Official Snyk endpoint: PATCH /orgs/{org_id}/settings/sast

Enable/Disable the Snyk Code settings for an org #### Required permissions - `View Organization (org.read)` - `Edit Organization (org.edit)`';
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
    'description' => 'Path parameter `org_id` from the official Snyk API operation. The id of the org for which we want to update the Snyk Code setting',
  ),
  'body' =>
  array (
    'type' => 'object',
    'required' => true,
    'description' => 'JSON request body matching the official Snyk API request schema.',
  ),
);
    protected const METHOD = 'patch';
    protected const PATH = '/orgs/{org_id}/settings/sast';
    protected const PATH_PARAMS = array (
  'org_id' => 'org_id',
);
    protected const QUERY_PARAMS = array (
  'version' => 'version',
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = true;
}
