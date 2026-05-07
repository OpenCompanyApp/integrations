<?php

namespace OpenCompany\Integrations\Svix\Tools;

/**
 * Rotate Operational Webhook Endpoint Secret using the official Svix API.
 */
class SvixRotateOperationalWebhookEndpointSecret extends AbstractSvixOperationTool
{
    protected const OPERATION = 'v1.operational-webhook.endpoint.rotate-secret';
}
