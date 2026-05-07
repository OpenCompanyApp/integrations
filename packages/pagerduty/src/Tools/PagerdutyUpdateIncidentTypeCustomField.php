<?php

namespace OpenCompany\Integrations\Pagerduty\Tools;

/**
 * Update a Custom Field for an Incident Type.
 *
 * Generated PagerDuty REST API tool for PUT /incidents/types/{type_id_or_name}/custom_fields/{field_id}.
 */
class PagerdutyUpdateIncidentTypeCustomField extends AbstractPagerdutyOperationTool
{
    protected const TOOL_NAME = 'pagerduty_update_incident_type_custom_field';
}