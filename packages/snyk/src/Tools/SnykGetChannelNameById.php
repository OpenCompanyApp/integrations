<?php

namespace OpenCompany\Integrations\Snyk\Tools;

/**
 * Get Slack Channel name by Slack Channel ID..
 *
 * Maps to the official Snyk endpoint get /orgs/{org_id}/slack_app/{tenant_id}/channels/{channel_id}.
 */
class SnykGetChannelNameById extends AbstractSnykTool
{
    protected const NAME = 'snyk_get_channel_name_by_id';
    protected const DESCRIPTION = 'Get Slack Channel name by Slack Channel ID.

Official Snyk endpoint: GET /orgs/{org_id}/slack_app/{tenant_id}/channels/{channel_id}

Requires the Snyk Slack App to be set up for this org. It will return the Slack channel name for the provided Slack channel ID. #### Required permissions - `Install Apps (org.app.install)`';
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
  'channel_id' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `channel_id` from the official Snyk API operation. Slack Channel ID',
  ),
  'tenant_id' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `tenant_id` from the official Snyk API operation. Tenant ID',
  ),
);
    protected const METHOD = 'get';
    protected const PATH = '/orgs/{org_id}/slack_app/{tenant_id}/channels/{channel_id}';
    protected const PATH_PARAMS = array (
  'org_id' => 'org_id',
  'channel_id' => 'channel_id',
  'tenant_id' => 'tenant_id',
);
    protected const QUERY_PARAMS = array (
  'version' => 'version',
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}
