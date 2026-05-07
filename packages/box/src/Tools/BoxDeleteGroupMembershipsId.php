<?php

namespace OpenCompany\Integrations\Box\Tools;

/**
 * Remove user from group.
 *
 * Executes the official Box API operation delete_group_memberships_id.
 */
class BoxDeleteGroupMembershipsId extends AbstractBoxOperationTool
{
    protected const OPERATION = 'box_delete_group_memberships_id';
}
