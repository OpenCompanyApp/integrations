<?php

namespace OpenCompany\Integrations\Beehiiv\Tools;

/**
 * Get email blast OAuth Scope: posts:read.
 *
 * Executes the official beehiiv API operation emailBlasts_show.
 */
class BeehiivEmailBlastsShow extends AbstractBeehiivOperationTool
{
    protected const OPERATION = 'beehiiv_email_blasts_show';
}
