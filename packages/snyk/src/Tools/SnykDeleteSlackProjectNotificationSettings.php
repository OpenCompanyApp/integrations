<?php

namespace OpenCompany\Integrations\Snyk\Tools;

/**
 * Remove Slack settings override for a project..
 *
 * Maps to the official Snyk endpoint delete /orgs/{org_id}/slack_app/{bot_id}/projects/{project_id}.
 */
class SnykDeleteSlackProjectNotificationSettings extends AbstractSnykTool
{
    protected const NAME = 'snyk_delete_slack_project_notification_settings';
    protected const DESCRIPTION = 'Remove Slack settings override for a project.

Official Snyk endpoint: DELETE /orgs/{org_id}/slack_app/{bot_id}/projects/{project_id}

Remove Slack settings override for a project. #### Required permissions - `Install Apps (org.app.install)`';
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
  'project_id' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `project_id` from the official Snyk API operation. Project ID',
  ),
  'bot_id' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `bot_id` from the official Snyk API operation. Bot ID',
  ),
);
    protected const METHOD = 'delete';
    protected const PATH = '/orgs/{org_id}/slack_app/{bot_id}/projects/{project_id}';
    protected const PATH_PARAMS = array (
  'org_id' => 'org_id',
  'project_id' => 'project_id',
  'bot_id' => 'bot_id',
);
    protected const QUERY_PARAMS = array (
  'version' => 'version',
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}
