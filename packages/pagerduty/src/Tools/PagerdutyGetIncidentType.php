<?php

namespace OpenCompany\Integrations\Pagerduty\Tools;

/**
 * Get an Incident Type.
 *
 * Generated PagerDuty REST API tool for GET /incidents/types/{type_id_or_name}.
 */
class PagerdutyGetIncidentType extends AbstractPagerdutyOperationTool
{
    protected const TOOL_NAME = 'pagerduty_get_incident_type';
}