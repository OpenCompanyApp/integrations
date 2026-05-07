<?php

namespace OpenCompany\Integrations\Box\Tools;

/**
 * Delete folder lock.
 *
 * Executes the official Box API operation delete_folder_locks_id.
 */
class BoxDeleteFolderLocksId extends AbstractBoxOperationTool
{
    protected const OPERATION = 'box_delete_folder_locks_id';
}
