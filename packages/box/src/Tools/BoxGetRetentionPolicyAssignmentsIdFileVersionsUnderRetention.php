<?php

namespace OpenCompany\Integrations\Box\Tools;

/**
 * Get file versions under retention.
 *
 * Executes the official Box API operation get_retention_policy_assignments_id_file_versions_under_retention.
 */
class BoxGetRetentionPolicyAssignmentsIdFileVersionsUnderRetention extends AbstractBoxOperationTool
{
    protected const OPERATION = 'box_get_retention_policy_assignments_id_file_versions_under_retention';
}
