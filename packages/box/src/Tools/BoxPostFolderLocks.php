<?php

namespace OpenCompany\Integrations\Box\Tools;

/**
 * Create folder lock.
 *
 * Executes the official Box API operation post_folder_locks.
 */
class BoxPostFolderLocks extends AbstractBoxOperationTool
{
    protected const OPERATION = 'box_post_folder_locks';
}
