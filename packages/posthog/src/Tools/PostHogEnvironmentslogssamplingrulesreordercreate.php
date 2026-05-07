<?php

declare(strict_types=1);

namespace OpenCompany\Integrations\PostHog\Tools;

/**
 * Atomically reassign priorities so the given ID order maps to ascending priorities (0..n-1).
 */
class PostHogEnvironmentslogssamplingrulesreordercreate extends AbstractPostHogOperationTool
{
    protected const TOOL_NAME = 'posthog_environmentslogssamplingrulesreordercreate';
}
