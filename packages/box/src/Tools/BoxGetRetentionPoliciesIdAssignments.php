<?php

namespace OpenCompany\Integrations\Box\Tools;

/**
 * List retention policy assignments.
 *
 * Executes the official Box API operation get_retention_policies_id_assignments.
 */
class BoxGetRetentionPoliciesIdAssignments extends AbstractBoxOperationTool
{
    protected const OPERATION = 'box_get_retention_policies_id_assignments';
}
