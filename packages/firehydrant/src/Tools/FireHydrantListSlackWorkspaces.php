<?php

namespace OpenCompany\Integrations\FireHydrant\Tools;

/**
 * List Slack workspaces.
 *
 * Maps to the official FireHydrant endpoint get /v1/integrations/slack/connections/{connection_id}/workspaces.
 */
class FireHydrantListSlackWorkspaces extends AbstractFireHydrantTool
{
    protected const NAME = 'firehydrant_list_slack_workspaces';
    protected const DESCRIPTION = 'List Slack workspaces

Official FireHydrant endpoint: GET /v1/integrations/slack/connections/{connection_id}/workspaces

Lists all Slack workspaces';
    protected const PARAMETERS = array (
  'connection_id' =>
  array (
    'type' => 'string',
    'description' => 'Connection UUID',
    'required' => true,
  ),
);
    protected const METHOD = 'get';
    protected const PATH = '/v1/integrations/slack/connections/{connection_id}/workspaces';
    protected const PATH_PARAMS = array (
  'connection_id' => 'connection_id',
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}
