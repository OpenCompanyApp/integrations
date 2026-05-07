<?php

namespace OpenCompany\Integrations\Box\Tools;

/**
 * Remove domain from list of allowed collaboration domains.
 *
 * Executes the official Box API operation delete_collaboration_whitelist_entries_id.
 */
class BoxDeleteCollaborationWhitelistEntriesId extends AbstractBoxOperationTool
{
    protected const OPERATION = 'box_delete_collaboration_whitelist_entries_id';
}
