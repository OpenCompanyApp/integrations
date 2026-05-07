<?php

namespace OpenCompany\Integrations\Snyk\Tools;

/**
 * Get the Infrastructure as Code Settings for a group.
 *
 * Maps to the official Snyk endpoint get /groups/{group_id}/settings/iac.
 */
class SnykGetIacSettingsForGroup extends AbstractSnykTool
{
    protected const NAME = 'snyk_get_iac_settings_for_group';
    protected const DESCRIPTION = 'Get the Infrastructure as Code Settings for a group

Official Snyk endpoint: GET /groups/{group_id}/settings/iac

Get the Infrastructure as Code Settings for a group. #### Required permissions - `View IaC settings (group.iac.settings.read)`';
    protected const PARAMETERS = array (
  'version' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Query parameter `version` from the official Snyk API operation. The requested version of the endpoint to process the request',
  ),
  'group_id' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `group_id` from the official Snyk API operation. The id of the group whose Infrastructure as Code settings are requested',
  ),
);
    protected const METHOD = 'get';
    protected const PATH = '/groups/{group_id}/settings/iac';
    protected const PATH_PARAMS = array (
  'group_id' => 'group_id',
);
    protected const QUERY_PARAMS = array (
  'version' => 'version',
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}
