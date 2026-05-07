<?php

namespace OpenCompany\Integrations\Beehiiv\Tools;

/**
 * Create data deletion request OAuth Scope: data_deletion:write.
 *
 * Executes the official beehiiv API operation dataDeletion_create.
 */
class BeehiivDataDeletionCreate extends AbstractBeehiivOperationTool
{
    protected const OPERATION = 'beehiiv_data_deletion_create';
}
