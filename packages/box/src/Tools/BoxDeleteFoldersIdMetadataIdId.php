<?php

namespace OpenCompany\Integrations\Box\Tools;

/**
 * Remove metadata instance from folder.
 *
 * Executes the official Box API operation delete_folders_id_metadata_id_id.
 */
class BoxDeleteFoldersIdMetadataIdId extends AbstractBoxOperationTool
{
    protected const OPERATION = 'box_delete_folders_id_metadata_id_id';
}
