<?php

namespace OpenCompany\Integrations\Box\Tools;

/**
 * Create retention policy.
 *
 * Executes the official Box API operation post_retention_policies.
 */
class BoxPostRetentionPolicies extends AbstractBoxOperationTool
{
    protected const OPERATION = 'box_post_retention_policies';
}
