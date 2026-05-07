<?php

namespace OpenCompany\Integrations\Box\Tools;

/**
 * Assign storage policy.
 *
 * Executes the official Box API operation post_storage_policy_assignments.
 */
class BoxPostStoragePolicyAssignments extends AbstractBoxOperationTool
{
    protected const OPERATION = 'box_post_storage_policy_assignments';
}
