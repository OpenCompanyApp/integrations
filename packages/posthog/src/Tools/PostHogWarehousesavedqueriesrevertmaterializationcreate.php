<?php

declare(strict_types=1);

namespace OpenCompany\Integrations\PostHog\Tools;

/**
 * Undo materialization, revert back to the original view. (i.e. delete the materialized table and the schedule)
 */
class PostHogWarehousesavedqueriesrevertmaterializationcreate extends AbstractPostHogOperationTool
{
    protected const TOOL_NAME = 'posthog_warehousesavedqueriesrevertmaterializationcreate';
}
