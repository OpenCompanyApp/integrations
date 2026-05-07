<?php

namespace OpenCompany\Integrations\Beehiiv\Tools;

/**
 * Create a tier OAuth Scope: tiers:write.
 *
 * Executes the official beehiiv API operation tiers_create.
 */
class BeehiivTiersCreate extends AbstractBeehiivOperationTool
{
    protected const OPERATION = 'beehiiv_tiers_create';
}
