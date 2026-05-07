<?php

namespace OpenCompany\Integrations\Snyk\Tools;

/**
 * Remove the given Slack App integration.
 *
 * Maps to the official Snyk endpoint delete /orgs/{org_id}/slack_app/{bot_id}.
 */
class SnykDeleteSlackDefaultNotificationSettings extends AbstractSnykTool
{
    protected const NAME = 'snyk_delete_slack_default_notification_settings';
    protected const DESCRIPTION = 'Remove the given Slack App integration

Official Snyk endpoint: DELETE /orgs/{org_id}/slack_app/{bot_id}

Remove the given Slack App integration #### Required permissions - `Install Apps (org.app.install)`';
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
  'bot_id' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `bot_id` from the official Snyk API operation. Bot ID',
  ),
);
    protected const METHOD = 'delete';
    protected const PATH = '/orgs/{org_id}/slack_app/{bot_id}';
    protected const PATH_PARAMS = array (
  'org_id' => 'org_id',
  'bot_id' => 'bot_id',
);
    protected const QUERY_PARAMS = array (
  'version' => 'version',
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}
