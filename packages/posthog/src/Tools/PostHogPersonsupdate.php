<?php

declare(strict_types=1);

namespace OpenCompany\Integrations\PostHog\Tools;

/**
 * Only for setting properties on the person. "properties" from the request data will be updated via a "$set" event. Thi...
 */
class PostHogPersonsupdate extends AbstractPostHogOperationTool
{
    protected const TOOL_NAME = 'posthog_personsupdate';
}
