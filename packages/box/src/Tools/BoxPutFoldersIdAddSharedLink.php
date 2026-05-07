<?php

namespace OpenCompany\Integrations\Box\Tools;

/**
 * Add shared link to folder.
 *
 * Executes the official Box API operation put_folders_id#add_shared_link.
 */
class BoxPutFoldersIdAddSharedLink extends AbstractBoxOperationTool
{
    protected const OPERATION = 'box_put_folders_id_add_shared_link';
}
