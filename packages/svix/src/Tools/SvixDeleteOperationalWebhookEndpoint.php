<?php

namespace OpenCompany\Integrations\Svix\Tools;

/**
 * Delete Operational Webhook Endpoint using the official Svix API.
 */
class SvixDeleteOperationalWebhookEndpoint extends AbstractSvixOperationTool
{
    protected const OPERATION = 'v1.operational-webhook.endpoint.delete';
}
