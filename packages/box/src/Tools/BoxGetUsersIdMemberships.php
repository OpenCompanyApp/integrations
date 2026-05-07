<?php

namespace OpenCompany\Integrations\Box\Tools;

/**
 * List user's groups.
 *
 * Executes the official Box API operation get_users_id_memberships.
 */
class BoxGetUsersIdMemberships extends AbstractBoxOperationTool
{
    protected const OPERATION = 'box_get_users_id_memberships';
}
