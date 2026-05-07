<?php

namespace OpenCompany\Integrations\Fivetran\Tools;

/**
 * Create a Group Webhook.
 *
 * Maps to the official Fivetran endpoint post /v1/webhooks/group/{groupId}.
 */
class FivetranCreateGroupWebhook extends AbstractFivetranTool
{
    protected const NAME = 'fivetran_create_group_webhook';
    protected const DESCRIPTION = 'Create a Group Webhook

Official Fivetran endpoint: POST /v1/webhooks/group/{groupId}

This endpoint allows you to create a new webhook for a given group';
    protected const PARAMETERS = array (
  'group_id' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `groupId` from the official Fivetran API operation. The unique identifier for the group within the Fivetran system.',
  ),
  'accept' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Header parameter `Accept` from the official Fivetran API operation.',
  ),
  'body' =>
  array (
    'type' => 'object',
    'required' => false,
    'description' => 'JSON request body matching the official Fivetran API request schema.',
  ),
);
    protected const METHOD = 'post';
    protected const PATH = '/v1/webhooks/group/{groupId}';
    protected const PATH_PARAMS = array (
  'groupId' => 'group_id',
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
  'Accept' => 'accept',
);
    protected const BODY_REQUIRED = false;
}
