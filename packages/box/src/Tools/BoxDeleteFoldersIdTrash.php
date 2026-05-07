<?php

namespace OpenCompany\Integrations\Box\Tools;

/**
 * Permanently remove folder.
 *
 * Executes the official Box API operation delete_folders_id_trash.
 */
class BoxDeleteFoldersIdTrash extends AbstractBoxOperationTool
{
    protected const OPERATION = 'box_delete_folders_id_trash';
}
