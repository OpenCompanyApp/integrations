<?php

namespace OpenCompany\Integrations\Snyk\Tools;

/**
 * Install a Snyk App for a Group.
 *
 * Maps to the official Snyk endpoint post /groups/{group_id}/apps/installs.
 */
class SnykCreateGroupAppInstall extends AbstractSnykTool
{
    protected const NAME = 'snyk_create_group_app_install';
    protected const DESCRIPTION = 'Install a Snyk App for a Group

Official Snyk endpoint: POST /groups/{group_id}/apps/installs

Install a Snyk App to this group, the Snyk App must use unattended authentication e.g. client credentials #### Required permissions - `Install Apps (group.app.install)`';
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
    'description' => 'Path parameter `group_id` from the official Snyk API operation. Group ID',
  ),
  'body' =>
  array (
    'type' => 'object',
    'required' => false,
    'description' => 'JSON request body matching the official Snyk API request schema.',
  ),
);
    protected const METHOD = 'post';
    protected const PATH = '/groups/{group_id}/apps/installs';
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
