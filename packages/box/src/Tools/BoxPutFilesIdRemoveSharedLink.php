<?php

namespace OpenCompany\Integrations\Box\Tools;

/**
 * Remove shared link from file.
 *
 * Executes the official Box API operation put_files_id#remove_shared_link.
 */
class BoxPutFilesIdRemoveSharedLink extends AbstractBoxOperationTool
{
    protected const OPERATION = 'box_put_files_id_remove_shared_link';
}
