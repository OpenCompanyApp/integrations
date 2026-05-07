<?php

namespace OpenCompany\Integrations\Box\Tools;

/**
 * Unassign storage policy.
 *
 * Executes the official Box API operation delete_storage_policy_assignments_id.
 */
class BoxDeleteStoragePolicyAssignmentsId extends AbstractBoxOperationTool
{
    protected const OPERATION = 'box_delete_storage_policy_assignments_id';
}
