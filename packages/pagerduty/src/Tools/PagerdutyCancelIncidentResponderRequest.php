<?php

namespace OpenCompany\Integrations\Pagerduty\Tools;

/**
 * Cancel responder requests for an incident.
 *
 * Generated PagerDuty REST API tool for PUT /incidents/{id}/responder_requests/cancel.
 */
class PagerdutyCancelIncidentResponderRequest extends AbstractPagerdutyOperationTool
{
    protected const TOOL_NAME = 'pagerduty_cancel_incident_responder_request';
}