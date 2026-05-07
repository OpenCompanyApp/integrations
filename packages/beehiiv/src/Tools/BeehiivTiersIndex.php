<?php

namespace OpenCompany\Integrations\Beehiiv\Tools;

/**
 * List tiers OAuth Scope: tiers:read.
 *
 * Executes the official beehiiv API operation tiers_index.
 */
class BeehiivTiersIndex extends AbstractBeehiivOperationTool
{
    protected const OPERATION = 'beehiiv_tiers_index';
}
