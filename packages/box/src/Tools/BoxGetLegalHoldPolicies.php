<?php

namespace OpenCompany\Integrations\Box\Tools;

/**
 * List all legal hold policies.
 *
 * Executes the official Box API operation get_legal_hold_policies.
 */
class BoxGetLegalHoldPolicies extends AbstractBoxOperationTool
{
    protected const OPERATION = 'box_get_legal_hold_policies';
}
