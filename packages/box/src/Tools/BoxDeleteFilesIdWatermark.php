<?php

namespace OpenCompany\Integrations\Box\Tools;

/**
 * Remove watermark from file.
 *
 * Executes the official Box API operation delete_files_id_watermark.
 */
class BoxDeleteFilesIdWatermark extends AbstractBoxOperationTool
{
    protected const OPERATION = 'box_delete_files_id_watermark';
}
