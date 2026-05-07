<?php

namespace OpenCompany\Integrations\Box\Tools;

/**
 * Remove legal hold policy.
 *
 * Executes the official Box API operation delete_legal_hold_policies_id.
 */
class BoxDeleteLegalHoldPoliciesId extends AbstractBoxOperationTool
{
    protected const OPERATION = 'box_delete_legal_hold_policies_id';
}
