<?php

namespace OpenCompany\Integrations\FireHydrant\Tools;

/**
 * Delete a Slack emoji action.
 *
 * Maps to the official FireHydrant endpoint delete /v1/integrations/slack/connections/{connection_id}/emoji_actions/{emoji_action_id}.
 */
class FireHydrantDeleteSlackEmojiAction extends AbstractFireHydrantTool
{
    protected const NAME = 'firehydrant_delete_slack_emoji_action';
    protected const DESCRIPTION = 'Delete a Slack emoji action

Official FireHydrant endpoint: DELETE /v1/integrations/slack/connections/{connection_id}/emoji_actions/{emoji_action_id}

Deletes a Slack emoji action';
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
);
    protected const METHOD = 'delete';
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
