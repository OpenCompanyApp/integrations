<?php

namespace OpenCompany\Integrations\Beehiiv\Tools;

/**
 * List automation journeys OAuth Scope: automations:read.
 *
 * Executes the official beehiiv API operation automationJourneys_index.
 */
class BeehiivAutomationJourneysIndex extends AbstractBeehiivOperationTool
{
    protected const OPERATION = 'beehiiv_automation_journeys_index';
}
