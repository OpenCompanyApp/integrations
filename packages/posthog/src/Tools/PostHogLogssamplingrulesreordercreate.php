<?php

declare(strict_types=1);

namespace OpenCompany\Integrations\PostHog\Tools;

/**
 * Atomically reassign priorities so the given ID order maps to ascending priorities (0..n-1).
 */
class PostHogLogssamplingrulesreordercreate extends AbstractPostHogOperationTool
{
    protected const TOOL_NAME = 'posthog_logssamplingrulesreordercreate';
}
