<?php

namespace OpenCompany\Integrations\Pagerduty\Tools;

/**
 * Get an event.
 *
 * Generated PagerDuty REST API tool for GET /v3/schedules/{id}/rotations/{rotation_id}/events/{event_id}.
 */
class PagerdutyGetEvent extends AbstractPagerdutyOperationTool
{
    protected const TOOL_NAME = 'pagerduty_get_event';
}