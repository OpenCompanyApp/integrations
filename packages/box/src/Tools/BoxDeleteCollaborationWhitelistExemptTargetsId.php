<?php

namespace OpenCompany\Integrations\Box\Tools;

/**
 * Remove user from list of users exempt from domain restrictions.
 *
 * Executes the official Box API operation delete_collaboration_whitelist_exempt_targets_id.
 */
class BoxDeleteCollaborationWhitelistExemptTargetsId extends AbstractBoxOperationTool
{
    protected const OPERATION = 'box_delete_collaboration_whitelist_exempt_targets_id';
}
