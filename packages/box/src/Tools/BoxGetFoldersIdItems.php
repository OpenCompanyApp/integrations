<?php

namespace OpenCompany\Integrations\Box\Tools;

/**
 * List items in folder.
 *
 * Executes the official Box API operation get_folders_id_items.
 */
class BoxGetFoldersIdItems extends AbstractBoxOperationTool
{
    protected const OPERATION = 'box_get_folders_id_items';
}
