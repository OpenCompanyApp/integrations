<?php

namespace OpenCompany\Integrations\Box\Tools;

/**
 * Assign legal hold policy.
 *
 * Executes the official Box API operation post_legal_hold_policy_assignments.
 */
class BoxPostLegalHoldPolicyAssignments extends AbstractBoxOperationTool
{
    protected const OPERATION = 'box_post_legal_hold_policy_assignments';
}
