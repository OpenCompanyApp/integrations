<?php

declare(strict_types=1);

namespace OpenCompany\Integrations\PostHog\Tools;

/**
 * Reset an experiment back to draft state. Clears start/end dates, conclusion, and archived flag. The feature flag is l...
 */
class PostHogExperimentsresetcreate extends AbstractPostHogOperationTool
{
    protected const TOOL_NAME = 'posthog_experimentsresetcreate';
}
