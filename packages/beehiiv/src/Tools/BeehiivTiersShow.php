<?php

namespace OpenCompany\Integrations\Beehiiv\Tools;

/**
 * Get tier OAuth Scope: tiers:read.
 *
 * Executes the official beehiiv API operation tiers_show.
 */
class BeehiivTiersShow extends AbstractBeehiivOperationTool
{
    protected const OPERATION = 'beehiiv_tiers_show';
}
