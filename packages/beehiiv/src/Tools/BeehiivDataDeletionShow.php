<?php

namespace OpenCompany\Integrations\Beehiiv\Tools;

/**
 * Get data deletion request OAuth Scope: data_deletion:read.
 *
 * Executes the official beehiiv API operation dataDeletion_show.
 */
class BeehiivDataDeletionShow extends AbstractBeehiivOperationTool
{
    protected const OPERATION = 'beehiiv_data_deletion_show';
}
