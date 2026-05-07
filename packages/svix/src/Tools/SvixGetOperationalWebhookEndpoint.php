<?php

namespace OpenCompany\Integrations\Svix\Tools;

/**
 * Get Operational Webhook Endpoint using the official Svix API.
 */
class SvixGetOperationalWebhookEndpoint extends AbstractSvixOperationTool
{
    protected const OPERATION = 'v1.operational-webhook.endpoint.get';
}
