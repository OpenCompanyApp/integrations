<?php

namespace OpenCompany\Integrations\Beehiiv\Tools;

/**
 * Add subscription to an automation OAuth Scope: automations:write.
 *
 * Executes the official beehiiv API operation automationJourneys_create.
 */
class BeehiivAutomationJourneysCreate extends AbstractBeehiivOperationTool
{
    protected const OPERATION = 'beehiiv_automation_journeys_create';
}
