<?php

namespace OpenCompany\Integrations\FireHydrant\Tools;

/**
 * Create a new Slack emoji action.
 *
 * Maps to the official FireHydrant endpoint post /v1/integrations/slack/connections/{connection_id}/emoji_actions.
 */
class FireHydrantCreateSlackEmojiAction extends AbstractFireHydrantTool
{
    protected const NAME = 'firehydrant_create_slack_emoji_action';
    protected const DESCRIPTION = 'Create a new Slack emoji action

Official FireHydrant endpoint: POST /v1/integrations/slack/connections/{connection_id}/emoji_actions

Creates a new Slack emoji action';
    protected const PARAMETERS = array (
  'connection_id' =>
  array (
    'type' => 'string',
    'description' => 'Slack Connection UUID',
    'required' => true,
  ),
  'body' =>
  array (
    'type' => 'object',
    'description' => 'JSON request body matching the FireHydrant API schema.',
    'required' => true,
  ),
);
    protected const METHOD = 'post';
    protected const PATH = '/v1/integrations/slack/connections/{connection_id}/emoji_actions';
    protected const PATH_PARAMS = array (
  'connection_id' => 'connection_id',
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = true;
}
