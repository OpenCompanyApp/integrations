<?php

declare(strict_types=1);

namespace OpenCompany\Integrations\PostHog\Tools;

/**
 * Commit draft to live tour. Runs full validation and triggers side effects. Accepts an optional body payload. If provi...
 */
class PostHogProducttourspublishdraftcreate extends AbstractPostHogOperationTool
{
    protected const TOOL_NAME = 'posthog_producttourspublishdraftcreate';
}
