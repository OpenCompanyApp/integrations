<?php

declare(strict_types=1);

namespace OpenCompany\Integrations\PostHog\Tools;

/**
 * Hard delete of this model is not allowed. Use a patch API call to set "deleted" to true
 */
class PostHogEnvironmentssubscriptionsdestroy extends AbstractPostHogOperationTool
{
    protected const TOOL_NAME = 'posthog_environmentssubscriptionsdestroy';
}
