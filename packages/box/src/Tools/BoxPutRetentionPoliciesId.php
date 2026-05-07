<?php

namespace OpenCompany\Integrations\Box\Tools;

/**
 * Update retention policy.
 *
 * Executes the official Box API operation put_retention_policies_id.
 */
class BoxPutRetentionPoliciesId extends AbstractBoxOperationTool
{
    protected const OPERATION = 'box_put_retention_policies_id';
}
