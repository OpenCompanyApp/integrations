<?php

namespace OpenCompany\Integrations\Box\Tools;

/**
 * Apply watermark to folder.
 *
 * Executes the official Box API operation put_folders_id_watermark.
 */
class BoxPutFoldersIdWatermark extends AbstractBoxOperationTool
{
    protected const OPERATION = 'box_put_folders_id_watermark';
}
