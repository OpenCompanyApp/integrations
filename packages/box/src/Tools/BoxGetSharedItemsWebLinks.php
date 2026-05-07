<?php

namespace OpenCompany\Integrations\Box\Tools;

/**
 * Find web link for shared link.
 *
 * Executes the official Box API operation get_shared_items#web_links.
 */
class BoxGetSharedItemsWebLinks extends AbstractBoxOperationTool
{
    protected const OPERATION = 'box_get_shared_items_web_links';
}
