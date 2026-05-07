<?php

namespace OpenCompany\Integrations\Box\Tools;

/**
 * Get trashed web link.
 *
 * Executes the official Box API operation get_web_links_id_trash.
 */
class BoxGetWebLinksIdTrash extends AbstractBoxOperationTool
{
    protected const OPERATION = 'box_get_web_links_id_trash';
}
