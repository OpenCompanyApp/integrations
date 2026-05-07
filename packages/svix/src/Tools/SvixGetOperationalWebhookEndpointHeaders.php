<?php

namespace OpenCompany\Integrations\Svix\Tools;

/**
 * Get Operational Webhook Endpoint Headers using the official Svix API.
 */
class SvixGetOperationalWebhookEndpointHeaders extends AbstractSvixOperationTool
{
    protected const OPERATION = 'v1.operational-webhook.endpoint.get-headers';
}
