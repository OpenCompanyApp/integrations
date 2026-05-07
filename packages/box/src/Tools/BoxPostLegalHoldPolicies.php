<?php

namespace OpenCompany\Integrations\Box\Tools;

/**
 * Create legal hold policy.
 *
 * Executes the official Box API operation post_legal_hold_policies.
 */
class BoxPostLegalHoldPolicies extends AbstractBoxOperationTool
{
    protected const OPERATION = 'box_post_legal_hold_policies';
}
