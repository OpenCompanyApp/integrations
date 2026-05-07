<?php

namespace OpenCompany\Integrations\Box\Tools;

/**
 * Update storage policy assignment.
 *
 * Executes the official Box API operation put_storage_policy_assignments_id.
 */
class BoxPutStoragePolicyAssignmentsId extends AbstractBoxOperationTool
{
    protected const OPERATION = 'box_put_storage_policy_assignments_id';
}
