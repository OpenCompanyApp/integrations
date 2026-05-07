<?php

namespace OpenCompany\Integrations\Box\Tools;

/**
 * Get retention policy.
 *
 * Executes the official Box API operation get_retention_policies_id.
 */
class BoxGetRetentionPoliciesId extends AbstractBoxOperationTool
{
    protected const OPERATION = 'box_get_retention_policies_id';
}
