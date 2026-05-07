<?php

namespace OpenCompany\Integrations\DailyCo\Tools;

/**
 * Delete Webhook using the official Daily REST API.
 */
class DailyCoDeleteWebhook extends AbstractDailyCoOperationTool
{
    protected const OPERATION = 'delete_webhook';
}
