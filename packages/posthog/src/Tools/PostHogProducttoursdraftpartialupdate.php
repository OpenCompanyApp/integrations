<?php

declare(strict_types=1);

namespace OpenCompany\Integrations\PostHog\Tools;

/**
 * Save draft content (server-side merge). No side effects triggered.
 */
class PostHogProducttoursdraftpartialupdate extends AbstractPostHogOperationTool
{
    protected const TOOL_NAME = 'posthog_producttoursdraftpartialupdate';
}
