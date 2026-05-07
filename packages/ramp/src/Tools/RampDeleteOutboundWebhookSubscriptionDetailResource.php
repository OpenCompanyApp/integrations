<?php

namespace OpenCompany\Integrations\Ramp\Tools;

/**
 * Delete a webhook subscription by id.
 *
 * Maps to the official Ramp endpoint delete /developer/v1/webhooks/{webhook_id}.
 */
class RampDeleteOutboundWebhookSubscriptionDetailResource extends AbstractRampTool
{
    protected const NAME = 'ramp_delete_outbound_webhook_subscription_detail_resource';
    protected const DESCRIPTION = 'Delete a webhook subscription by id

Official Ramp endpoint: DELETE /developer/v1/webhooks/{webhook_id}';
    protected const PARAMETERS = array (
  'webhook_id' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `webhook_id` from the official Ramp API operation.',
  ),
);
    protected const METHOD = 'delete';
    protected const PATH = '/developer/v1/webhooks/{webhook_id}';
    protected const PATH_PARAMS = array (
  'webhook_id' => 'webhook_id',
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}
