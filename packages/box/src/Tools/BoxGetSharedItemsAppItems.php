<?php

namespace OpenCompany\Integrations\Box\Tools;

/**
 * Find app item for shared link.
 *
 * Executes the official Box API operation get_shared_items#app_items.
 */
class BoxGetSharedItemsAppItems extends AbstractBoxOperationTool
{
    protected const OPERATION = 'box_get_shared_items_app_items';
}
