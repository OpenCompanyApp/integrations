<?php

declare(strict_types=1);

namespace OpenCompany\Integrations\PostHog\Tools;

/**
 * Returns a paginated list of feature flags eligible for use in experiments. Eligible flags must: - Be multivariate wit...
 */
class PostHogExperimentseligiblefeatureflagsretrieve extends AbstractPostHogOperationTool
{
    protected const TOOL_NAME = 'posthog_experimentseligiblefeatureflagsretrieve';
}
