<?php

namespace OpenCompany\Integrations\Beehiiv\Tools;

/**
 * Get publication OAuth Scope: publications:read.
 *
 * Executes the official beehiiv API operation publications_show.
 */
class BeehiivPublicationsShow extends AbstractBeehiivOperationTool
{
    protected const OPERATION = 'beehiiv_publications_show';
}
