<?php

namespace OpenCompany\Integrations\Beehiiv\Tools;

/**
 * Get publication engagements OAuth Scope: publications:read.
 *
 * Executes the official beehiiv API operation engagements_index.
 */
class BeehiivEngagementsIndex extends AbstractBeehiivOperationTool
{
    protected const OPERATION = 'beehiiv_engagements_index';
}
