<?php

namespace OpenCompany\Integrations\Copper\Tools;

/**
 * List Copper webhook subscriptions.
 */
class CopperListWebhooks extends AbstractCopperEndpointTool
{
    protected string $toolName = 'copper_list_webhooks';

    protected string $toolDescription = 'List all Copper webhook subscriptions.';

    protected string $path = '/webhooks';
}
