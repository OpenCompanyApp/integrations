<?php

namespace OpenCompany\Integrations\Box\Tools;

/**
 * List users exempt from collaboration domain restrictions.
 *
 * Executes the official Box API operation get_collaboration_whitelist_exempt_targets.
 */
class BoxGetCollaborationWhitelistExemptTargets extends AbstractBoxOperationTool
{
    protected const OPERATION = 'box_get_collaboration_whitelist_exempt_targets';
}
