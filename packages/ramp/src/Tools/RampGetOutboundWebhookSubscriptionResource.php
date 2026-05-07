<?php

namespace OpenCompany\Integrations\Ramp\Tools;

/**
 * Get all webhook subscriptions.
 *
 * Maps to the official Ramp endpoint get /developer/v1/webhooks.
 */
class RampGetOutboundWebhookSubscriptionResource extends AbstractRampTool
{
    protected const NAME = 'ramp_get_outbound_webhook_subscription_resource';
    protected const DESCRIPTION = 'Get all webhook subscriptions

Official Ramp endpoint: GET /developer/v1/webhooks';
    protected const PARAMETERS = array (
);
    protected const METHOD = 'get';
    protected const PATH = '/developer/v1/webhooks';
    protected const PATH_PARAMS = array (
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}
