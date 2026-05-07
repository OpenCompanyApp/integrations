<?php

declare(strict_types=1);

namespace OpenCompany\Integrations\PostHog\Tools;

/**
 * Serve a snapshot thumbnail by identifier. Returns WebP with ETag caching.
 */
class PostHogVisualreviewreposthumbnailsretrieve extends AbstractPostHogOperationTool
{
    protected const TOOL_NAME = 'posthog_visualreviewreposthumbnailsretrieve';
}
