<?php

namespace OpenCompany\Integrations\Box\Tools;

/**
 * Remove watermark from folder.
 *
 * Executes the official Box API operation delete_folders_id_watermark.
 */
class BoxDeleteFoldersIdWatermark extends AbstractBoxOperationTool
{
    protected const OPERATION = 'box_delete_folders_id_watermark';
}
