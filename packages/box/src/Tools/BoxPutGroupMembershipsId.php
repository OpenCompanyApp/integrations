<?php

namespace OpenCompany\Integrations\Box\Tools;

/**
 * Update group membership.
 *
 * Executes the official Box API operation put_group_memberships_id.
 */
class BoxPutGroupMembershipsId extends AbstractBoxOperationTool
{
    protected const OPERATION = 'box_put_group_memberships_id';
}
