<?php

namespace OpenCompany\Integrations\Box\Tools;

/**
 * Update shared link on folder.
 *
 * Executes the official Box API operation put_folders_id#update_shared_link.
 */
class BoxPutFoldersIdUpdateSharedLink extends AbstractBoxOperationTool
{
    protected const OPERATION = 'box_put_folders_id_update_shared_link';
}
