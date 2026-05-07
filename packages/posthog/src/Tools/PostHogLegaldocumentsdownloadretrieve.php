<?php

declare(strict_types=1);

namespace OpenCompany\Integrations\PostHog\Tools;

/**
 * Short-lived redirect to the signed PDF in object storage. 404 while the envelope is still out for signature (or if th...
 */
class PostHogLegaldocumentsdownloadretrieve extends AbstractPostHogOperationTool
{
    protected const TOOL_NAME = 'posthog_legaldocumentsdownloadretrieve';
}
