<?php

namespace OpenCompany\Integrations\Box\Tools;

/**
 * Copy folder.
 *
 * Executes the official Box API operation post_folders_id_copy.
 */
class BoxPostFoldersIdCopy extends AbstractBoxOperationTool
{
    protected const OPERATION = 'box_post_folders_id_copy';
}
