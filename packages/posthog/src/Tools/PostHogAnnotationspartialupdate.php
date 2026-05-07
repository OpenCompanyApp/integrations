<?php

declare(strict_types=1);

namespace OpenCompany\Integrations\PostHog\Tools;

/**
 * Create, Read, Update and Delete annotations. [See docs](https://posthog.com/docs/data/annotations) for more informati...
 */
class PostHogAnnotationspartialupdate extends AbstractPostHogOperationTool
{
    protected const TOOL_NAME = 'posthog_annotationspartialupdate';
}
