<?php

declare(strict_types=1);

namespace OpenCompany\Integrations\PostHog\Tools;

/**
 * When object storage is available this API allows upload of media which can be used, for example, in text cards on das...
 */
class PostHogUploadedmediacreate extends AbstractPostHogOperationTool
{
    protected const TOOL_NAME = 'posthog_uploadedmediacreate';
}
