<?php

namespace OpenCompany\Integrations\Box\Tools;

/**
 * List recently accessed items.
 *
 * Executes the official Box API operation get_recent_items.
 */
class BoxGetRecentItems extends AbstractBoxOperationTool
{
    protected const OPERATION = 'box_get_recent_items';
}
