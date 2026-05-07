<?php

declare(strict_types=1);

namespace OpenCompany\Integrations\PostHog\Tools;

/**
 * Fetch current schema/table list from the source and create any new ExternalDataSchema rows (no data sync).
 */
class PostHogEnvironmentsexternaldatasourcesrefreshschemascreate extends AbstractPostHogOperationTool
{
    protected const TOOL_NAME = 'posthog_environmentsexternaldatasourcesrefreshschemascreate';
}
