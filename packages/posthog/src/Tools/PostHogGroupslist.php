<?php

declare(strict_types=1);

namespace OpenCompany\Integrations\PostHog\Tools;

/**
 * List all groups of a specific group type. You must pass ?grouptypeindex= in the URL. To get a list of valid group typ...
 */
class PostHogGroupslist extends AbstractPostHogOperationTool
{
    protected const TOOL_NAME = 'posthog_groupslist';
}
