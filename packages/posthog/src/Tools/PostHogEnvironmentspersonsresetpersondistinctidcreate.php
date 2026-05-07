<?php

declare(strict_types=1);

namespace OpenCompany\Integrations\PostHog\Tools;

/**
 * Reset a distinctid for a deleted person. This allows the distinctid to be used again.
 */
class PostHogEnvironmentspersonsresetpersondistinctidcreate extends AbstractPostHogOperationTool
{
    protected const TOOL_NAME = 'posthog_environmentspersonsresetpersondistinctidcreate';
}
