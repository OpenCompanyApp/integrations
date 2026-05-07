<?php

namespace OpenCompany\Integrations\Airbyte\Tools;

/**
 * List all organizations for a user.
 *
 * Maps to the official Airbyte endpoint get /organizations.
 */
class AirbyteListOrganizationsForUser extends AbstractAirbyteTool
{
    protected const NAME = 'airbyte_list_organizations_for_user';
    protected const DESCRIPTION = 'List all organizations for a user

Official Airbyte endpoint: GET /organizations

Lists users organizations.';
    protected const PARAMETERS = array (
);
    protected const METHOD = 'get';
    protected const PATH = '/organizations';
    protected const PATH_PARAMS = array (
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}
