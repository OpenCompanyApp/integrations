<?php

namespace OpenCompany\Integrations\Box\Tools;

/**
 * List legal hold policy assignments.
 *
 * Executes the official Box API operation get_legal_hold_policy_assignments.
 */
class BoxGetLegalHoldPolicyAssignments extends AbstractBoxOperationTool
{
    protected const OPERATION = 'box_get_legal_hold_policy_assignments';
}
