<?php

namespace OpenCompany\Integrations\Pagerduty\Tools;

/**
 * Delete a Custom Field for an Incident Type.
 *
 * Generated PagerDuty REST API tool for DELETE /incidents/types/{type_id_or_name}/custom_fields/{field_id}.
 */
class PagerdutyDeleteIncidentTypeCustomField extends AbstractPagerdutyOperationTool
{
    protected const TOOL_NAME = 'pagerduty_delete_incident_type_custom_field';
}