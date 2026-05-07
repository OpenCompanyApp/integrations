<?php

namespace OpenCompany\Integrations\Svix\Tools;

/**
 * Update Operational Webhook Endpoint Headers using the official Svix API.
 */
class SvixUpdateOperationalWebhookEndpointHeaders extends AbstractSvixOperationTool
{
    protected const OPERATION = 'v1.operational-webhook.endpoint.update-headers';
}
