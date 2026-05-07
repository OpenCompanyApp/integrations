<?php

namespace OpenCompany\Integrations\Beehiiv\Tools;

/**
 * Get automation OAuth Scope: automations:read.
 *
 * Executes the official beehiiv API operation automations_show.
 */
class BeehiivAutomationsShow extends AbstractBeehiivOperationTool
{
    protected const OPERATION = 'beehiiv_automations_show';
}
