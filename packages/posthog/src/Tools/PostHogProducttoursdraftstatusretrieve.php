<?php

declare(strict_types=1);

namespace OpenCompany\Integrations\PostHog\Tools;

/**
 * Lightweight polling endpoint for draft change detection.
 */
class PostHogProducttoursdraftstatusretrieve extends AbstractPostHogOperationTool
{
    protected const TOOL_NAME = 'posthog_producttoursdraftstatusretrieve';
}
