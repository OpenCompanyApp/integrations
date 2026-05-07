<?php

namespace OpenCompany\Integrations\Box\Tools;

/**
 * Add shared link to file.
 *
 * Executes the official Box API operation put_files_id#add_shared_link.
 */
class BoxPutFilesIdAddSharedLink extends AbstractBoxOperationTool
{
    protected const OPERATION = 'box_put_files_id_add_shared_link';
}
