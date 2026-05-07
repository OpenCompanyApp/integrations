<?php

namespace OpenCompany\Integrations\Box\Tools;

/**
 * List storage policy assignments.
 *
 * Executes the official Box API operation get_storage_policy_assignments.
 */
class BoxGetStoragePolicyAssignments extends AbstractBoxOperationTool
{
    protected const OPERATION = 'box_get_storage_policy_assignments';
}
