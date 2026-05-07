<?php

namespace OpenCompany\Integrations\Box\Tools;

/**
 * Get webhook.
 *
 * Executes the official Box API operation get_webhooks_id.
 */
class BoxGetWebhooksId extends AbstractBoxOperationTool
{
    protected const OPERATION = 'box_get_webhooks_id';
}
