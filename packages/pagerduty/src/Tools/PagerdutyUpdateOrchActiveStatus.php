<?php

namespace OpenCompany\Integrations\Pagerduty\Tools;

/**
 * Update the Service Orchestration active status for a Service.
 *
 * Generated PagerDuty REST API tool for PUT /event_orchestrations/services/{service_id}/active.
 */
class PagerdutyUpdateOrchActiveStatus extends AbstractPagerdutyOperationTool
{
    protected const TOOL_NAME = 'pagerduty_update_orch_active_status';
}