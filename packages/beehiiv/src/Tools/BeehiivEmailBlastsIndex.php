<?php

namespace OpenCompany\Integrations\Beehiiv\Tools;

/**
 * List email blasts OAuth Scope: posts:read.
 *
 * Executes the official beehiiv API operation emailBlasts_index.
 */
class BeehiivEmailBlastsIndex extends AbstractBeehiivOperationTool
{
    protected const OPERATION = 'beehiiv_email_blasts_index';
}
