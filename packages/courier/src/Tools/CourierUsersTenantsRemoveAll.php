<?php

namespace OpenCompany\Integrations\Courier\Tools;

/**
 * Removes a user from any tenants they may have been associated with.
 */
class CourierUsersTenantsRemoveAll extends AbstractCourierOperationTool
{
    protected const OPERATION = 'courier_users_tenants_remove_all';
}
