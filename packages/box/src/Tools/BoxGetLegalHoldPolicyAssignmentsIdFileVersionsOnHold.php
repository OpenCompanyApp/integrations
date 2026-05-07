<?php

namespace OpenCompany\Integrations\Box\Tools;

/**
 * List previous file versions for legal hold policy assignment.
 *
 * Executes the official Box API operation get_legal_hold_policy_assignments_id_file_versions_on_hold.
 */
class BoxGetLegalHoldPolicyAssignmentsIdFileVersionsOnHold extends AbstractBoxOperationTool
{
    protected const OPERATION = 'box_get_legal_hold_policy_assignments_id_file_versions_on_hold';
}
