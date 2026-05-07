<?php

namespace OpenCompany\Integrations\Box\Tools;

/**
 * List allowed collaboration domains.
 *
 * Executes the official Box API operation get_collaboration_whitelist_entries.
 */
class BoxGetCollaborationWhitelistEntries extends AbstractBoxOperationTool
{
    protected const OPERATION = 'box_get_collaboration_whitelist_entries';
}
