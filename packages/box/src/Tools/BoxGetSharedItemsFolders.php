<?php

namespace OpenCompany\Integrations\Box\Tools;

/**
 * Find folder for shared link.
 *
 * Executes the official Box API operation get_shared_items#folders.
 */
class BoxGetSharedItemsFolders extends AbstractBoxOperationTool
{
    protected const OPERATION = 'box_get_shared_items_folders';
}
