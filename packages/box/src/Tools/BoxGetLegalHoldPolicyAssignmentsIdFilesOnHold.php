<?php

namespace OpenCompany\Integrations\Box\Tools;

/**
 * List files with current file versions for legal hold policy assignment.
 *
 * Executes the official Box API operation get_legal_hold_policy_assignments_id_files_on_hold.
 */
class BoxGetLegalHoldPolicyAssignmentsIdFilesOnHold extends AbstractBoxOperationTool
{
    protected const OPERATION = 'box_get_legal_hold_policy_assignments_id_files_on_hold';
}
