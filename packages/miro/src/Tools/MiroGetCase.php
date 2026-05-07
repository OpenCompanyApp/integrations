<?php

namespace OpenCompany\Integrations\Miro\Tools;

/**
 * Retrieves information about a case in an organization. Required scope organization:cases:management Rate limiting Level 3 Enterprise Guard only This API is available only for Enterprise plan users with the Enterprise Guard add-on. You can only use this endpoint if you have both the Company Admin and eDiscovery Admin roles..
 *
 * Maps to the official Miro endpoint GET /v2/orgs/{org_id}/cases/{case_id}.
 */
class MiroGetCase extends AbstractMiroTool
{
    protected const NAME = 'miro_get_case';
    protected const DESCRIPTION = 'Retrieves information about a case in an organization. Required scope organization:cases:management Rate limiting Level 3 Enterprise Guard only This API is available only for Enterprise plan users with the Enterprise Guard add-on. You can only use this endpoint if you have both the Company Admin and eDiscovery Admin roles.

Official Miro endpoint: GET /v2/orgs/{org_id}/cases/{case_id}.';
    protected const PARAMETERS = array (
      'org_id' => array (
        'type' => 'string',
        'description' => 'The ID of the organization for which you want to retrieve the case information.',
        'required' => true,
      ),
      'case_id' => array (
        'type' => 'string',
        'description' => 'The ID of the case you want to retrieve.',
        'required' => true,
      ),
    );
    protected const METHOD = 'GET';
    protected const PATH = '/v2/orgs/{org_id}/cases/{case_id}';
    protected const PATH_PARAMS = array (
      'org_id' => 'org_id',
      'case_id' => 'case_id',
    );
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
    protected const BODY_CONTENT_TYPE = 'application/json';
}
