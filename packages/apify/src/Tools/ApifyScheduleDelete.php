<?php

namespace OpenCompany\Integrations\Apify\Tools;

/**
 * Delete schedule.
 *
 * Executes the official Apify API operation schedule_delete.
 */
class ApifyScheduleDelete extends AbstractApifyOperationTool
{
    protected const OPERATION = 'apify_schedule_delete';
}
