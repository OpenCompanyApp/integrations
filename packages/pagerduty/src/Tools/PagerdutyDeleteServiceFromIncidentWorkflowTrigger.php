<?php

namespace OpenCompany\Integrations\Pagerduty\Tools;

/**
 * Dissociate a Trigger and Service.
 *
 * Generated PagerDuty REST API tool for DELETE /incident_workflows/triggers/{trigger_id}/services/{service_id}.
 */
class PagerdutyDeleteServiceFromIncidentWorkflowTrigger extends AbstractPagerdutyOperationTool
{
    protected const TOOL_NAME = 'pagerduty_delete_service_from_incident_workflow_trigger';
}