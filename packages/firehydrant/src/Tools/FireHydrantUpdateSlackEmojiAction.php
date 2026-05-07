<?php

namespace OpenCompany\Integrations\FireHydrant\Tools;

/**
 * Update a Slack emoji action.
 *
 * Maps to the official FireHydrant endpoint patch /v1/integrations/slack/connections/{connection_id}/emoji_actions/{emoji_action_id}.
 */
class FireHydrantUpdateSlackEmojiAction extends AbstractFireHydrantTool
{
    protected const NAME = 'firehydrant_update_slack_emoji_action';
    protected const DESCRIPTION = 'Update a Slack emoji action

Official FireHydrant endpoint: PATCH /v1/integrations/slack/connections/{connection_id}/emoji_actions/{emoji_action_id}

Updates a Slack emoji action';
    protected const PARAMETERS = array (
  'connection_id' =>
  array (
    'type' => 'string',
    'description' => 'Slack Connection UUID',
    'required' => true,
  ),
  'emoji_action_id' =>
  array (
    'type' => 'string',
    'description' => 'emoji_action_id parameter.',
    'required' => true,
  ),
  'body' =>
  array (
    'type' => 'object',
    'description' => 'JSON request body matching the FireHydrant API schema.',
  ),
);
    protected const METHOD = 'patch';
    protected const PATH = '/v1/integrations/slack/connections/{connection_id}/emoji_actions/{emoji_action_id}';
    protected const PATH_PARAMS = array (
  'connection_id' => 'connection_id',
  'emoji_action_id' => 'emoji_action_id',
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}
