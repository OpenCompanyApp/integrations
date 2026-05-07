<?php

namespace OpenCompany\Integrations\Apify\Tools;

/**
 * Get list of webhooks.
 *
 * Executes the official Apify API operation actorTask_webhooks_get.
 */
class ApifyActorTaskWebhooksGet extends AbstractApifyOperationTool
{
    protected const OPERATION = 'apify_actor_task_webhooks_get';
}
