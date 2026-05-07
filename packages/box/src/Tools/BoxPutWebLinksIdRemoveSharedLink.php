<?php

namespace OpenCompany\Integrations\Box\Tools;

/**
 * Remove shared link from web link.
 *
 * Executes the official Box API operation put_web_links_id#remove_shared_link.
 */
class BoxPutWebLinksIdRemoveSharedLink extends AbstractBoxOperationTool
{
    protected const OPERATION = 'box_put_web_links_id_remove_shared_link';
}
