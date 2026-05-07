<?php

namespace OpenCompany\Integrations\DailyCo\Tools;

/**
 * List Webhooks using the official Daily REST API.
 */
class DailyCoListWebhooks extends AbstractDailyCoOperationTool
{
    protected const OPERATION = 'get_webhooks';
}
