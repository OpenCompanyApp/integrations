<?php

declare(strict_types=1);

namespace OpenCompany\Integrations\PostHog\Tools;

/**
 * ViewSet for BatchExportBackfill models. Allows creating and reading backfills, but not updating or deleting them.
 */
class PostHogEnvironmentsbatchexportsbackfillsretrieve extends AbstractPostHogOperationTool
{
    protected const TOOL_NAME = 'posthog_environmentsbatchexportsbackfillsretrieve';
}
