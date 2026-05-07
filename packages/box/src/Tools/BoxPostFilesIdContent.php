<?php

namespace OpenCompany\Integrations\Box\Tools;

/**
 * Upload file version.
 *
 * Executes the official Box API operation post_files_id_content.
 */
class BoxPostFilesIdContent extends AbstractBoxOperationTool
{
    protected const OPERATION = 'box_post_files_id_content';
}
