<?php

declare(strict_types=1);

namespace OpenCompany\Integrations\PostHog\Tools;

/**
 * List quarantined identifiers. Without filter: active only. With identifier: full history.
 */
class PostHogVisualreviewreposquarantinelist extends AbstractPostHogOperationTool
{
    protected const TOOL_NAME = 'posthog_visualreviewreposquarantinelist';
}
