<?php

namespace OpenCompany\Integrations\Box\Tools;

/**
 * Upload file.
 *
 * Executes the official Box API operation post_files_content.
 */
class BoxPostFilesContent extends AbstractBoxOperationTool
{
    protected const OPERATION = 'box_post_files_content';
}
