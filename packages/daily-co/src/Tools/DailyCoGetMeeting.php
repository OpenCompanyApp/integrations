<?php

namespace OpenCompany\Integrations\DailyCo\Tools;

/**
 * Get Meeting using the official Daily REST API.
 */
class DailyCoGetMeeting extends AbstractDailyCoOperationTool
{
    protected const OPERATION = 'get_individual_meeting_info';
}
