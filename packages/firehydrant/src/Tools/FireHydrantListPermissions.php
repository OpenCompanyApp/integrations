<?php

namespace OpenCompany\Integrations\FireHydrant\Tools;

/**
 * List permissions.
 *
 * Maps to the official FireHydrant endpoint get /v1/permissions.
 */
class FireHydrantListPermissions extends AbstractFireHydrantTool
{
    protected const NAME = 'firehydrant_list_permissions';
    protected const DESCRIPTION = 'List permissions

Official FireHydrant endpoint: GET /v1/permissions

List all permissions in the organization';
    protected const PARAMETERS = array (
);
    protected const METHOD = 'get';
    protected const PATH = '/v1/permissions';
    protected const PATH_PARAMS = array (
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}
