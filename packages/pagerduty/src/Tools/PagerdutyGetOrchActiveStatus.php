<?php

namespace OpenCompany\Integrations\Pagerduty\Tools;

/**
 * Get the Service Orchestration active status for a Service.
 *
 * Generated PagerDuty REST API tool for GET /event_orchestrations/services/{service_id}/active.
 */
class PagerdutyGetOrchActiveStatus extends AbstractPagerdutyOperationTool
{
    protected const TOOL_NAME = 'pagerduty_get_orch_active_status';
}