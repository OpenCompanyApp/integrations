<?php

namespace OpenCompany\Integrations\Snyk\Tools;

/**
 * Create a new Slack settings override for a given project..
 *
 * Maps to the official Snyk endpoint post /orgs/{org_id}/slack_app/{bot_id}/projects/{project_id}.
 */
class SnykCreateSlackProjectNotificationSettings extends AbstractSnykTool
{
    protected const NAME = 'snyk_create_slack_project_notification_settings';
    protected const DESCRIPTION = 'Create a new Slack settings override for a given project.

Official Snyk endpoint: POST /orgs/{org_id}/slack_app/{bot_id}/projects/{project_id}

Create Slack settings override for a project. #### Required permissions - `Install Apps (org.app.install)`';
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
  'body' =>
  array (
    'type' => 'object',
    'required' => false,
    'description' => 'JSON request body matching the official Snyk API request schema.',
  ),
);
    protected const METHOD = 'post';
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
