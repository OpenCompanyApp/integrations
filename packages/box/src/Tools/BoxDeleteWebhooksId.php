<?php

namespace OpenCompany\Integrations\Box\Tools;

/**
 * Remove webhook.
 *
 * Executes the official Box API operation delete_webhooks_id.
 */
class BoxDeleteWebhooksId extends AbstractBoxOperationTool
{
    protected const OPERATION = 'box_delete_webhooks_id';
}
