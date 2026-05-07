<?php

namespace OpenCompany\Integrations\Svix\Tools;

/**
 * List Operational Webhook Endpoints using the official Svix API.
 */
class SvixListOperationalWebhookEndpoints extends AbstractSvixOperationTool
{
    protected const OPERATION = 'v1.operational-webhook.endpoint.list';
}
