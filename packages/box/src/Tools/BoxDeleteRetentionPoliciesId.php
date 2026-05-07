<?php

namespace OpenCompany\Integrations\Box\Tools;

/**
 * Delete retention policy.
 *
 * Executes the official Box API operation delete_retention_policies_id.
 */
class BoxDeleteRetentionPoliciesId extends AbstractBoxOperationTool
{
    protected const OPERATION = 'box_delete_retention_policies_id';
}
