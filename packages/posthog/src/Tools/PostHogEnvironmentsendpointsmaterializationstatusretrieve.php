<?php

declare(strict_types=1);

namespace OpenCompany\Integrations\PostHog\Tools;

/**
 * Get materialization status for an endpoint. Supports ?version=N query param.
 */
class PostHogEnvironmentsendpointsmaterializationstatusretrieve extends AbstractPostHogOperationTool
{
    protected const TOOL_NAME = 'posthog_environmentsendpointsmaterializationstatusretrieve';
}
