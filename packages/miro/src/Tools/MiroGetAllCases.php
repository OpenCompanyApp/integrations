<?php

namespace OpenCompany\Integrations\Miro\Tools;

/**
 * Retrieves the list of eDiscovery cases in an organization. Required scope organization:cases:management Rate limiting Level 4 Enterprise Guard only This API is available only for Enterprise plan users with the Enterprise Guard add-on. You can only use this endpoint if you have both the Company Admin and eDiscovery Admin roles..
 *
 * Maps to the official Miro endpoint GET /v2/orgs/{org_id}/cases.
 */
class MiroGetAllCases extends AbstractMiroTool
{
    protected const NAME = 'miro_get_all_cases';
    protected const DESCRIPTION = 'Retrieves the list of eDiscovery cases in an organization. Required scope organization:cases:management Rate limiting Level 4 Enterprise Guard only This API is available only for Enterprise plan users with the Enterprise Guard add-on. You can only use this endpoint if you have both the Company Admin and eDiscovery Admin roles.

Official Miro endpoint: GET /v2/orgs/{org_id}/cases.';
    protected const PARAMETERS = array (
      'limit' => array (
        'type' => 'integer',
        'description' => 'The maximum number of items in the result list.',
        'required' => false,
      ),
      'cursor' => array (
        'type' => 'string',
        'description' => 'An indicator of the position of a page in the full set of results. To obtain the first page leave it empty. To obtain subsequent pages set it to the value returned in the cursor field of the previous request.',
        'required' => false,
      ),
      'org_id' => array (
        'type' => 'string',
        'description' => 'The ID of the organization for which you want to retrieve the list of cases.',
        'required' => true,
      ),
    );
    protected const METHOD = 'GET';
    protected const PATH = '/v2/orgs/{org_id}/cases';
    protected const PATH_PARAMS = array (
      'org_id' => 'org_id',
    );
    protected const QUERY_PARAMS = array (
      'limit' => 'limit',
      'cursor' => 'cursor',
    );
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
    protected const BODY_CONTENT_TYPE = 'application/json';
}
