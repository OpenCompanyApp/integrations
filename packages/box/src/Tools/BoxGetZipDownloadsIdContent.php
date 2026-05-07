<?php

namespace OpenCompany\Integrations\Box\Tools;

/**
 * Download zip archive.
 *
 * Executes the official Box API operation get_zip_downloads_id_content.
 */
class BoxGetZipDownloadsIdContent extends AbstractBoxOperationTool
{
    protected const OPERATION = 'box_get_zip_downloads_id_content';
}
