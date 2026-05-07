<?php

namespace OpenCompany\Integrations\Box\Tools;

/**
 * Add shared link to web link.
 *
 * Executes the official Box API operation put_web_links_id#add_shared_link.
 */
class BoxPutWebLinksIdAddSharedLink extends AbstractBoxOperationTool
{
    protected const OPERATION = 'box_put_web_links_id_add_shared_link';
}
