<?php

namespace OpenCompany\Integrations\Box\Tools;

/**
 * List members of group.
 *
 * Executes the official Box API operation get_groups_id_memberships.
 */
class BoxGetGroupsIdMemberships extends AbstractBoxOperationTool
{
    protected const OPERATION = 'box_get_groups_id_memberships';
}
