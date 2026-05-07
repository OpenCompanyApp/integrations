<?php

namespace OpenCompany\Integrations\Beehiiv\Tools;

/**
 * List polls OAuth Scope: polls:read.
 *
 * Executes the official beehiiv API operation polls_index.
 */
class BeehiivPollsIndex extends AbstractBeehiivOperationTool
{
    protected const OPERATION = 'beehiiv_polls_index';
}
