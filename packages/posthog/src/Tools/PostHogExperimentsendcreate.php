<?php

declare(strict_types=1);

namespace OpenCompany\Integrations\PostHog\Tools;

/**
 * End a running experiment without shipping a variant. Sets enddate to now and marks the experiment as stopped. The fea...
 */
class PostHogExperimentsendcreate extends AbstractPostHogOperationTool
{
    protected const TOOL_NAME = 'posthog_experimentsendcreate';
}
