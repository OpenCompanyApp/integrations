<?php

namespace OpenCompany\Integrations\Box\Tools;

/**
 * Add user to group.
 *
 * Executes the official Box API operation post_group_memberships.
 */
class BoxPostGroupMemberships extends AbstractBoxOperationTool
{
    protected const OPERATION = 'box_post_group_memberships';
}
