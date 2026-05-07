<?php

namespace OpenCompany\Integrations\Box\Tools;

/**
 * Remove shared link from folder.
 *
 * Executes the official Box API operation put_folders_id#remove_shared_link.
 */
class BoxPutFoldersIdRemoveSharedLink extends AbstractBoxOperationTool
{
    protected const OPERATION = 'box_put_folders_id_remove_shared_link';
}
