<?php

namespace OpenCompany\Integrations\FireHydrant\Tools;

/**
 * List Slack emoji actions.
 *
 * Maps to the official FireHydrant endpoint get /v1/integrations/slack/connections/{connection_id}/emoji_actions.
 */
class FireHydrantListSlackEmojiActions extends AbstractFireHydrantTool
{
    protected const NAME = 'firehydrant_list_slack_emoji_actions';
    protected const DESCRIPTION = 'List Slack emoji actions

Official FireHydrant endpoint: GET /v1/integrations/slack/connections/{connection_id}/emoji_actions

Lists Slack emoji actions';
    protected const PARAMETERS = array (
  'connection_id' =>
  array (
    'type' => 'string',
    'description' => 'Slack Connection UUID',
    'required' => true,
  ),
  'page' =>
  array (
    'type' => 'integer',
    'description' => 'page parameter.',
  ),
  'per_page' =>
  array (
    'type' => 'integer',
    'description' => 'per_page parameter.',
  ),
);
    protected const METHOD = 'get';
    protected const PATH = '/v1/integrations/slack/connections/{connection_id}/emoji_actions';
    protected const PATH_PARAMS = array (
  'connection_id' => 'connection_id',
);
    protected const QUERY_PARAMS = array (
  'page' => 'page',
  'per_page' => 'per_page',
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}
