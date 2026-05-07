<?php

declare(strict_types=1);

namespace OpenCompany\Integrations\PostHog\Tools;

/**
 * Retrieve an endpoint, or a specific version via ?version=N.
 */
class PostHogEnvironmentsendpointsretrieve extends AbstractPostHogOperationTool
{
    protected const TOOL_NAME = 'posthog_environmentsendpointsretrieve';
}
