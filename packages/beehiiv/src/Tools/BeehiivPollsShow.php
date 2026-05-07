<?php

namespace OpenCompany\Integrations\Beehiiv\Tools;

/**
 * Get poll OAuth Scope: polls:read.
 *
 * Executes the official beehiiv API operation polls_show.
 */
class BeehiivPollsShow extends AbstractBeehiivOperationTool
{
    protected const OPERATION = 'beehiiv_polls_show';
}
