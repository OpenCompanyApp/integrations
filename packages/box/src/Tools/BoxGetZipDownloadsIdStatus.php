<?php

namespace OpenCompany\Integrations\Box\Tools;

/**
 * Get zip download status.
 *
 * Executes the official Box API operation get_zip_downloads_id_status.
 */
class BoxGetZipDownloadsIdStatus extends AbstractBoxOperationTool
{
    protected const OPERATION = 'box_get_zip_downloads_id_status';
}
