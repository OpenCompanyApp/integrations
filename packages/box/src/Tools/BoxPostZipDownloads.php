<?php

namespace OpenCompany\Integrations\Box\Tools;

/**
 * Create zip download.
 *
 * Executes the official Box API operation post_zip_downloads.
 */
class BoxPostZipDownloads extends AbstractBoxOperationTool
{
    protected const OPERATION = 'box_post_zip_downloads';
}
