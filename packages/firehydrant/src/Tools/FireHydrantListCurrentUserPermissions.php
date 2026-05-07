<?php

namespace OpenCompany\Integrations\FireHydrant\Tools;

/**
 * Get all permissions for the current user.
 *
 * Maps to the official FireHydrant endpoint get /v1/permissions/current_user.
 */
class FireHydrantListCurrentUserPermissions extends AbstractFireHydrantTool
{
    protected const NAME = 'firehydrant_list_current_user_permissions';
    protected const DESCRIPTION = 'Get all permissions for the current user

Official FireHydrant endpoint: GET /v1/permissions/current_user

Get all permissions for the current user';
    protected const PARAMETERS = array (
);
    protected const METHOD = 'get';
    protected const PATH = '/v1/permissions/current_user';
    protected const PATH_PARAMS = array (
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}
