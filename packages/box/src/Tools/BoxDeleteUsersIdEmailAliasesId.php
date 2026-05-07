<?php

namespace OpenCompany\Integrations\Box\Tools;

/**
 * Remove email alias.
 *
 * Executes the official Box API operation delete_users_id_email_aliases_id.
 */
class BoxDeleteUsersIdEmailAliasesId extends AbstractBoxOperationTool
{
    protected const OPERATION = 'box_delete_users_id_email_aliases_id';
}
