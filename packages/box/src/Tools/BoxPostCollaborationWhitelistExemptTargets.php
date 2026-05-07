<?php

namespace OpenCompany\Integrations\Box\Tools;

/**
 * Create user exemption from collaboration domain restrictions.
 *
 * Executes the official Box API operation post_collaboration_whitelist_exempt_targets.
 */
class BoxPostCollaborationWhitelistExemptTargets extends AbstractBoxOperationTool
{
    protected const OPERATION = 'box_post_collaboration_whitelist_exempt_targets';
}
