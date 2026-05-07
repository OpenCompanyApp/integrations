<?php

namespace OpenCompany\Integrations\Box\Tools;

/**
 * List retention policies.
 *
 * Executes the official Box API operation get_retention_policies.
 */
class BoxGetRetentionPolicies extends AbstractBoxOperationTool
{
    protected const OPERATION = 'box_get_retention_policies';
}
