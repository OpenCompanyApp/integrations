<?php

namespace OpenCompany\Integrations\Box\Tools;

/**
 * Get files under retention.
 *
 * Executes the official Box API operation get_retention_policy_assignments_id_files_under_retention.
 */
class BoxGetRetentionPolicyAssignmentsIdFilesUnderRetention extends AbstractBoxOperationTool
{
    protected const OPERATION = 'box_get_retention_policy_assignments_id_files_under_retention';
}
