<?php

namespace OpenCompany\Integrations\Box\Tools;

/**
 * Permanently remove file.
 *
 * Executes the official Box API operation delete_files_id_trash.
 */
class BoxDeleteFilesIdTrash extends AbstractBoxOperationTool
{
    protected const OPERATION = 'box_delete_files_id_trash';
}
