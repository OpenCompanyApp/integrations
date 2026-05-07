<?php

namespace OpenCompany\Integrations\Box\Tools;

/**
 * Get user exempt from collaboration domain restrictions.
 *
 * Executes the official Box API operation get_collaboration_whitelist_exempt_targets_id.
 */
class BoxGetCollaborationWhitelistExemptTargetsId extends AbstractBoxOperationTool
{
    protected const OPERATION = 'box_get_collaboration_whitelist_exempt_targets_id';
}
