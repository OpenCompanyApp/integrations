<?php

declare(strict_types=1);

namespace OpenCompany\Integrations\PostHog\Tools;

/**
 * Return current processing state including pause status.
 */
class PostHogSignalsprocessinglist extends AbstractPostHogOperationTool
{
    protected const TOOL_NAME = 'posthog_signalsprocessinglist';
}
