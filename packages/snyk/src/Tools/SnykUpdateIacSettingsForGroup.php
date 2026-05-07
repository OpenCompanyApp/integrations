<?php

namespace OpenCompany\Integrations\Snyk\Tools;

/**
 * Update the Infrastructure as Code Settings for a group.
 *
 * Maps to the official Snyk endpoint patch /groups/{group_id}/settings/iac.
 */
class SnykUpdateIacSettingsForGroup extends AbstractSnykTool
{
    protected const NAME = 'snyk_update_iac_settings_for_group';
    protected const DESCRIPTION = 'Update the Infrastructure as Code Settings for a group

Official Snyk endpoint: PATCH /groups/{group_id}/settings/iac

Update the Infrastructure as Code Settings for a group. #### Required permissions - `Edit IaC settings (group.iac.settings.edit)`';
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
    'description' => 'Path parameter `group_id` from the official Snyk API operation. The id of the group whose Infrastructure as Code settings are getting updated',
  ),
  'body' =>
  array (
    'type' => 'object',
    'required' => false,
    'description' => 'JSON request body matching the official Snyk API request schema.',
  ),
);
    protected const METHOD = 'patch';
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
