<?php

namespace OpenCompany\Integrations\Box\Tools;

/**
 * List all webhooks.
 *
 * Executes the official Box API operation get_webhooks.
 */
class BoxGetWebhooks extends AbstractBoxOperationTool
{
    protected const OPERATION = 'box_get_webhooks';
}
