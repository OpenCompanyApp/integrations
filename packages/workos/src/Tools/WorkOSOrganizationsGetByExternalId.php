<?php

namespace OpenCompany\Integrations\WorkOS\Tools;

/**
 * Get an Organization by External ID.
 *
 * Maps to the official WorkOS endpoint get /organizations/external_id/{external_id}.
 */
class WorkOSOrganizationsGetByExternalId extends AbstractWorkOSTool
{
    protected const NAME = 'workos_organizations_get_by_external_id';
    protected const DESCRIPTION = 'Get an Organization by External ID

Official WorkOS endpoint: GET /organizations/external_id/{external_id}

Get the details of an existing organization by an [external identifier](/authkit/metadata/external-identifiers).';
    protected const PARAMETERS = array (
  'external_id' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `external_id` from the official WorkOS API operation.',
  ),
);
    protected const METHOD = 'get';
    protected const PATH = '/organizations/external_id/{external_id}';
    protected const PATH_PARAMS = array (
  'external_id' => 'external_id',
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}
