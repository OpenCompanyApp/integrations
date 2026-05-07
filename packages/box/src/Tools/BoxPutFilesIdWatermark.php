<?php

namespace OpenCompany\Integrations\Box\Tools;

/**
 * Apply watermark to file.
 *
 * Executes the official Box API operation put_files_id_watermark.
 */
class BoxPutFilesIdWatermark extends AbstractBoxOperationTool
{
    protected const OPERATION = 'box_put_files_id_watermark';
}
