<?php

declare(strict_types=1);

namespace OpenCompany\Integrations\PostHog\Tools;

/**
 * Get other active flags that depend on this flag.
 */
class PostHogFeatureflagsdependentflagslist extends AbstractPostHogOperationTool
{
    protected const TOOL_NAME = 'posthog_featureflagsdependentflagslist';
}
