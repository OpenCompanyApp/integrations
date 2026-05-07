<?php

namespace OpenCompany\Integrations\Box\Tools;

/**
 * Create webhook.
 *
 * Executes the official Box API operation post_webhooks.
 */
class BoxPostWebhooks extends AbstractBoxOperationTool
{
    protected const OPERATION = 'box_post_webhooks';
}
