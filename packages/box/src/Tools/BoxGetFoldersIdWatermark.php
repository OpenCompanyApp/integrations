<?php

namespace OpenCompany\Integrations\Box\Tools;

/**
 * Get watermark for folder.
 *
 * Executes the official Box API operation get_folders_id_watermark.
 */
class BoxGetFoldersIdWatermark extends AbstractBoxOperationTool
{
    protected const OPERATION = 'box_get_folders_id_watermark';
}
