<?php

namespace OpenCompany\Integrations\Beehiiv\Tools;

/**
 * List data deletion requests OAuth Scope: data_deletion:read.
 *
 * Executes the official beehiiv API operation dataDeletion_index.
 */
class BeehiivDataDeletionIndex extends AbstractBeehiivOperationTool
{
    protected const OPERATION = 'beehiiv_data_deletion_index';
}
