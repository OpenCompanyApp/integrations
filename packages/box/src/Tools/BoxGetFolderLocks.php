<?php

namespace OpenCompany\Integrations\Box\Tools;

/**
 * List folder locks.
 *
 * Executes the official Box API operation get_folder_locks.
 */
class BoxGetFolderLocks extends AbstractBoxOperationTool
{
    protected const OPERATION = 'box_get_folder_locks';
}
