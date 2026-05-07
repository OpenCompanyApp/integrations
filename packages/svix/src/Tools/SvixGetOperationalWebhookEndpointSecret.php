<?php

namespace OpenCompany\Integrations\Svix\Tools;

/**
 * Get Operational Webhook Endpoint Secret using the official Svix API.
 */
class SvixGetOperationalWebhookEndpointSecret extends AbstractSvixOperationTool
{
    protected const OPERATION = 'v1.operational-webhook.endpoint.get-secret';
}
