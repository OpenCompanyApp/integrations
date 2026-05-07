<?php

namespace OpenCompany\Integrations\Box\Tools;

/**
 * List metadata instances on folder.
 *
 * Executes the official Box API operation get_folders_id_metadata.
 */
class BoxGetFoldersIdMetadata extends AbstractBoxOperationTool
{
    protected const OPERATION = 'box_get_folders_id_metadata';
}
