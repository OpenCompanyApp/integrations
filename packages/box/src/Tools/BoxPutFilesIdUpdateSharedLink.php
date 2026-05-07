<?php

namespace OpenCompany\Integrations\Box\Tools;

/**
 * Update shared link on file.
 *
 * Executes the official Box API operation put_files_id#update_shared_link.
 */
class BoxPutFilesIdUpdateSharedLink extends AbstractBoxOperationTool
{
    protected const OPERATION = 'box_put_files_id_update_shared_link';
}
