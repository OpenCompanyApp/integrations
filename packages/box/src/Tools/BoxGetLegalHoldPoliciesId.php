<?php

namespace OpenCompany\Integrations\Box\Tools;

/**
 * Get legal hold policy.
 *
 * Executes the official Box API operation get_legal_hold_policies_id.
 */
class BoxGetLegalHoldPoliciesId extends AbstractBoxOperationTool
{
    protected const OPERATION = 'box_get_legal_hold_policies_id';
}
