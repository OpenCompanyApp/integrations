<?php

namespace OpenCompany\Integrations\Pagerduty\Tools;

/**
 * Migrate an Integration from one Event Orchestration to another.
 *
 * Generated PagerDuty REST API tool for POST /event_orchestrations/{id}/integrations/migration.
 */
class PagerdutyMigrateOrchestrationIntegration extends AbstractPagerdutyOperationTool
{
    protected const TOOL_NAME = 'pagerduty_migrate_orchestration_integration';
}