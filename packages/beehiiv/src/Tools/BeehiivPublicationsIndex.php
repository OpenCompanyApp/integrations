<?php

namespace OpenCompany\Integrations\Beehiiv\Tools;

/**
 * List publications OAuth Scope: publications:read.
 *
 * Executes the official beehiiv API operation publications_index.
 */
class BeehiivPublicationsIndex extends AbstractBeehiivOperationTool
{
    protected const OPERATION = 'beehiiv_publications_index';
}
