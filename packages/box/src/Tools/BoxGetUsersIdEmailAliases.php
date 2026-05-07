<?php

namespace OpenCompany\Integrations\Box\Tools;

/**
 * List user's email aliases.
 *
 * Executes the official Box API operation get_users_id_email_aliases.
 */
class BoxGetUsersIdEmailAliases extends AbstractBoxOperationTool
{
    protected const OPERATION = 'box_get_users_id_email_aliases';
}
