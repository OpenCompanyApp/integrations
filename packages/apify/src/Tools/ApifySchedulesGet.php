<?php

namespace OpenCompany\Integrations\Apify\Tools;

/**
 * Get list of schedules.
 *
 * Executes the official Apify API operation schedules_get.
 */
class ApifySchedulesGet extends AbstractApifyOperationTool
{
    protected const OPERATION = 'apify_schedules_get';
}
