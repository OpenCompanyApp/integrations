<?php

namespace OpenCompany\Integrations\Svix\Tools;

/**
 * Create Operational Webhook Endpoint using the official Svix API.
 */
class SvixCreateOperationalWebhookEndpoint extends AbstractSvixOperationTool
{
    protected const OPERATION = 'v1.operational-webhook.endpoint.create';
}
