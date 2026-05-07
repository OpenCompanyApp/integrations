<?php

namespace OpenCompany\Integrations\Pagerduty\Tools;

/**
 * Get an Incident Type Custom Field.
 *
 * Generated PagerDuty REST API tool for GET /incidents/types/{type_id_or_name}/custom_fields/{field_id}.
 */
class PagerdutyGetIncidentTypeCustomField extends AbstractPagerdutyOperationTool
{
    protected const TOOL_NAME = 'pagerduty_get_incident_type_custom_field';
}