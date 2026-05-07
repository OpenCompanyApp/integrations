<?php

namespace OpenCompany\Integrations\Miro\Tools;

/**
 * Creating a case for legal hold is the first critical step in the eDiscovery process when litigation or an investigation is anticipated. One of the purposes of creating a case is that it acts as a container that allows admins to group multiple legal holds under one case. For more information, see our Help Center page on creating a case. This API creates a new case in an organization. Required scope organization:cases:management Rate limiting Level 4 Enterprise Guard only This API is available only for Enterprise plan users with the Enterprise Guard add-on. You can only use this endpoint if you have both the Company Admin and eDiscovery Admin roles..
 *
 * Maps to the official Miro endpoint POST /v2/orgs/{org_id}/cases.
 */
class MiroCreateCase extends AbstractMiroTool
{
    protected const NAME = 'miro_create_case';
    protected const DESCRIPTION = 'Creating a case for legal hold is the first critical step in the eDiscovery process when litigation or an investigation is anticipated. One of the purposes of creating a case is that it acts as a container that allows admins to group multiple legal holds under one case. For more information, see our Help Center page on creating a case. This API creates a new case in an organization. Required scope organization:cases:management Rate limiting Level 4 Enterprise Guard only This API is available only for Enterprise plan users with the Enterprise Guard add-on. You can only use this endpoint if you have both the Company Admin and eDiscovery Admin roles.

Official Miro endpoint: POST /v2/orgs/{org_id}/cases.';
    protected const PARAMETERS = array (
      'org_id' => array (
        'type' => 'string',
        'description' => 'The ID of the organization in which you want to create a new case.',
        'required' => true,
      ),
      'body' => array (
        'type' => 'object',
        'description' => 'Request body matching the Miro API schema.',
        'required' => true,
      ),
    );
    protected const METHOD = 'POST';
    protected const PATH = '/v2/orgs/{org_id}/cases';
    protected const PATH_PARAMS = array (
      'org_id' => 'org_id',
    );
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = true;
    protected const BODY_CONTENT_TYPE = 'application/json';
}
