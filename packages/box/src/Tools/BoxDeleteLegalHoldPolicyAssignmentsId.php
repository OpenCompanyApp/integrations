<?php

namespace OpenCompany\Integrations\Box\Tools;

/**
 * Unassign legal hold policy.
 *
 * Executes the official Box API operation delete_legal_hold_policy_assignments_id.
 */
class BoxDeleteLegalHoldPolicyAssignmentsId extends AbstractBoxOperationTool
{
    protected const OPERATION = 'box_delete_legal_hold_policy_assignments_id';
}
