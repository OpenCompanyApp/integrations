<?php

namespace OpenCompany\Integrations\Box\Tools;

/**
 * Remove group.
 *
 * Executes the official Box API operation delete_groups_id.
 */
class BoxDeleteGroupsId extends AbstractBoxOperationTool
{
    protected const OPERATION = 'box_delete_groups_id';
}
