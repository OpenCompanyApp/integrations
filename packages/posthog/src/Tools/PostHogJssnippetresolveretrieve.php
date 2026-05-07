<?php

declare(strict_types=1);

namespace OpenCompany\Integrations\PostHog\Tools;

/**
 * Preview what a given pin would resolve to, without saving it.
 */
class PostHogJssnippetresolveretrieve extends AbstractPostHogOperationTool
{
    protected const TOOL_NAME = 'posthog_jssnippetresolveretrieve';
}
