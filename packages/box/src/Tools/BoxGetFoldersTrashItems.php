<?php

namespace OpenCompany\Integrations\Box\Tools;

/**
 * List trashed items.
 *
 * Executes the official Box API operation get_folders_trash_items.
 */
class BoxGetFoldersTrashItems extends AbstractBoxOperationTool
{
    protected const OPERATION = 'box_get_folders_trash_items';
}
