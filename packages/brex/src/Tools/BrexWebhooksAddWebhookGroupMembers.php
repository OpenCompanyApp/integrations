<?php

namespace OpenCompany\Integrations\Brex\Tools;

/**
 * Add Webhook Group Members.
 *
 * Maps to the official Brex endpoint post /v1/webhooks/groups/{id}/add_members.
 */
class BrexWebhooksAddWebhookGroupMembers extends AbstractBrexTool
{
    protected const NAME = 'brex_webhooks_add_webhook_group_members';
    protected const DESCRIPTION = 'Add Webhook Group Members

Official Brex endpoint: POST /v1/webhooks/groups/{id}/add_members

Adds members to webhook groups.';
    protected const PARAMETERS = array (
  'id' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `id` from the official Brex API operation.',
  ),
  'body' =>
  array (
    'type' => 'object',
    'required' => true,
    'description' => 'JSON request body matching the official Brex OpenAPI request schema for this operation.',
  ),
);
    protected const METHOD = 'post';
    protected const PATH = '/v1/webhooks/groups/{id}/add_members';
    protected const PATH_PARAMS = array (
  'id' => 'id',
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = true;
}
