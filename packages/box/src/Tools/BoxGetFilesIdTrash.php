<?php

namespace OpenCompany\Integrations\Box\Tools;

/**
 * Get trashed file.
 *
 * Executes the official Box API operation get_files_id_trash.
 */
class BoxGetFilesIdTrash extends AbstractBoxOperationTool
{
    protected const OPERATION = 'box_get_files_id_trash';
}
