<?php

namespace OpenCompany\Integrations\Box\Tools;

/**
 * Update legal hold policy.
 *
 * Executes the official Box API operation put_legal_hold_policies_id.
 */
class BoxPutLegalHoldPoliciesId extends AbstractBoxOperationTool
{
    protected const OPERATION = 'box_put_legal_hold_policies_id';
}
