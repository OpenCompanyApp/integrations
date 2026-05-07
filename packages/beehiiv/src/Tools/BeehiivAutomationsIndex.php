<?php

namespace OpenCompany\Integrations\Beehiiv\Tools;

/**
 * List automations OAuth Scope: automations:read.
 *
 * Executes the official beehiiv API operation automations_index.
 */
class BeehiivAutomationsIndex extends AbstractBeehiivOperationTool
{
    protected const OPERATION = 'beehiiv_automations_index';
}
