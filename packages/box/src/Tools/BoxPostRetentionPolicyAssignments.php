<?php

namespace OpenCompany\Integrations\Box\Tools;

/**
 * Assign retention policy.
 *
 * Executes the official Box API operation post_retention_policy_assignments.
 */
class BoxPostRetentionPolicyAssignments extends AbstractBoxOperationTool
{
    protected const OPERATION = 'box_post_retention_policy_assignments';
}
