<?php

declare(strict_types=1);

namespace OpenCompany\Integrations\PostHog\Tools;

/**
 * Retry a batch export run. We use the same underlying mechanism as when backfilling a batch export, as retrying a run...
 */
class PostHogEnvironmentsbatchexportsrunsretrycreate extends AbstractPostHogOperationTool
{
    protected const TOOL_NAME = 'posthog_environmentsbatchexportsrunsretrycreate';
}
