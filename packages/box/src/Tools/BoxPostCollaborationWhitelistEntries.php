<?php

namespace OpenCompany\Integrations\Box\Tools;

/**
 * Add domain to list of allowed collaboration domains.
 *
 * Executes the official Box API operation post_collaboration_whitelist_entries.
 */
class BoxPostCollaborationWhitelistEntries extends AbstractBoxOperationTool
{
    protected const OPERATION = 'box_post_collaboration_whitelist_entries';
}
