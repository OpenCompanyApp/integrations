<?php

namespace OpenCompany\Integrations\Beehiiv\Tools;

/**
 * Get automation journey OAuth Scope: automations:read.
 *
 * Executes the official beehiiv API operation automationJourneys_show.
 */
class BeehiivAutomationJourneysShow extends AbstractBeehiivOperationTool
{
    protected const OPERATION = 'beehiiv_automation_journeys_show';
}
