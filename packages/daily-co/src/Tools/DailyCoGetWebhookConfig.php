<?php

namespace OpenCompany\Integrations\DailyCo\Tools;

/**
 * Get Webhook Config using the official Daily REST API.
 */
class DailyCoGetWebhookConfig extends AbstractDailyCoOperationTool
{
    protected const OPERATION = 'get_webhook_config';
}
