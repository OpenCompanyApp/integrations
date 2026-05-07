<?php

declare(strict_types=1);

namespace OpenCompany\Integrations\PostHog\Tools;

/**
 * Allows a caller to provide a list of event names and a single property name Returns a map of the event names to a boo...
 */
class PostHogPropertydefinitionsseentogetherretrieve extends AbstractPostHogOperationTool
{
    protected const TOOL_NAME = 'posthog_propertydefinitionsseentogetherretrieve';
}
