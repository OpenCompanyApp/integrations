<?php

namespace OpenCompany\Integrations\DailyCo\Tools;

/**
 * Validate Meeting Token using the official Daily REST API.
 */
class DailyCoValidateMeetingToken extends AbstractDailyCoOperationTool
{
    protected const OPERATION = 'validate_meeting_token';
}
