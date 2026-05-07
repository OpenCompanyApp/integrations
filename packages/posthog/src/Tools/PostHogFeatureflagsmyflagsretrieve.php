<?php

declare(strict_types=1);

namespace OpenCompany\Integrations\PostHog\Tools;

/**
 * Create, read, update and delete feature flags. [See docs](https://posthog.com/docs/feature-flags) for more informatio...
 */
class PostHogFeatureflagsmyflagsretrieve extends AbstractPostHogOperationTool
{
    protected const TOOL_NAME = 'posthog_featureflagsmyflagsretrieve';
}
