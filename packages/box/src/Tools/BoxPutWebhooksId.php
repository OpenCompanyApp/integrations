<?php

namespace OpenCompany\Integrations\Box\Tools;

/**
 * Update webhook.
 *
 * Executes the official Box API operation put_webhooks_id.
 */
class BoxPutWebhooksId extends AbstractBoxOperationTool
{
    protected const OPERATION = 'box_put_webhooks_id';
}
