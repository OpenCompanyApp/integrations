<?php

namespace OpenCompany\Integrations\Box\Tools;

/**
 * Permanently remove web link.
 *
 * Executes the official Box API operation delete_web_links_id_trash.
 */
class BoxDeleteWebLinksIdTrash extends AbstractBoxOperationTool
{
    protected const OPERATION = 'box_delete_web_links_id_trash';
}
