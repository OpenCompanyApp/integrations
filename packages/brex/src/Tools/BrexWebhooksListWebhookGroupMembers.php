<?php

namespace OpenCompany\Integrations\Brex\Tools;

/**
 * List Webhook Group Members.
 *
 * Maps to the official Brex endpoint get /v1/webhooks/groups/{id}/members.
 */
class BrexWebhooksListWebhookGroupMembers extends AbstractBrexTool
{
    protected const NAME = 'brex_webhooks_list_webhook_group_members';
    protected const DESCRIPTION = 'List Webhook Group Members

Official Brex endpoint: GET /v1/webhooks/groups/{id}/members

Lists the members currently in the specified webhook group.';
    protected const PARAMETERS = array (
  'cursor' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Query parameter `cursor` from the official Brex API operation.',
  ),
  'limit' =>
  array (
    'type' => 'integer',
    'required' => false,
    'description' => 'Query parameter `limit` from the official Brex API operation.',
  ),
  'id' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `id` from the official Brex API operation.',
  ),
);
    protected const METHOD = 'get';
    protected const PATH = '/v1/webhooks/groups/{id}/members';
    protected const PATH_PARAMS = array (
  'id' => 'id',
);
    protected const QUERY_PARAMS = array (
  'cursor' => 'cursor',
  'limit' => 'limit',
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}
