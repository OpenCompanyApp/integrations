<?php

namespace OpenCompany\Integrations\Box\Tools;

/**
 * Remove retention policy assignment.
 *
 * Executes the official Box API operation delete_retention_policy_assignments_id.
 */
class BoxDeleteRetentionPolicyAssignmentsId extends AbstractBoxOperationTool
{
    protected const OPERATION = 'box_delete_retention_policy_assignments_id';
}
