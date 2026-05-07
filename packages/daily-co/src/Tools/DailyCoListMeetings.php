<?php

namespace OpenCompany\Integrations\DailyCo\Tools;

/**
 * List Meetings using the official Daily REST API.
 */
class DailyCoListMeetings extends AbstractDailyCoOperationTool
{
    protected const OPERATION = 'get_meeting_info';
}
