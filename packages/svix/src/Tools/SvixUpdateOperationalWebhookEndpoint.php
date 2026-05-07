<?php

namespace OpenCompany\Integrations\Svix\Tools;

/**
 * Update Operational Webhook Endpoint using the official Svix API.
 */
class SvixUpdateOperationalWebhookEndpoint extends AbstractSvixOperationTool
{
    protected const OPERATION = 'v1.operational-webhook.endpoint.update';
}
