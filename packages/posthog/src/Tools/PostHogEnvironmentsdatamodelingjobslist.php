<?php

declare(strict_types=1);

namespace OpenCompany\Integrations\PostHog\Tools;

/**
 * List data modeling jobs which are "runs" for our saved queries.
 */
class PostHogEnvironmentsdatamodelingjobslist extends AbstractPostHogOperationTool
{
    protected const TOOL_NAME = 'posthog_environmentsdatamodelingjobslist';
}
