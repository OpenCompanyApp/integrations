<?php

namespace OpenCompany\Integrations\Box\Tools;

/**
 * Get allowed collaboration domain.
 *
 * Executes the official Box API operation get_collaboration_whitelist_entries_id.
 */
class BoxGetCollaborationWhitelistEntriesId extends AbstractBoxOperationTool
{
    protected const OPERATION = 'box_get_collaboration_whitelist_entries_id';
}
