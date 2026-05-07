<?php

namespace OpenCompany\Integrations\Box\Tools;

/**
 * Get watermark on file.
 *
 * Executes the official Box API operation get_files_id_watermark.
 */
class BoxGetFilesIdWatermark extends AbstractBoxOperationTool
{
    protected const OPERATION = 'box_get_files_id_watermark';
}
