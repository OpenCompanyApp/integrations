<?php

namespace OpenCompany\Integrations\Pagerduty\Tools;

/**
 * Delete an event.
 *
 * Generated PagerDuty REST API tool for DELETE /v3/schedules/{id}/rotations/{rotation_id}/events/{event_id}.
 */
class PagerdutyDeleteEvent extends AbstractPagerdutyOperationTool
{
    protected const TOOL_NAME = 'pagerduty_delete_event';
}