<?php

namespace OpenCompany\Integrations\Miro\Tools;

/**
 * Closing a case is the final stage in the eDiscovery process, marking the conclusion of a legal matter or investigation. You must ensure that all associated legal holds within the case are closed before closing the case. Closing a case will permanently delete it. For more information, see our Help Center page on closing a case. This API closes a case in an organization. Required scope organization:cases:management Rate limiting Level 4 Enterprise Guard only This API is available only for Enterprise plan users with the Enterprise Guard add-on. You can only use this endpoint if you have both the Company Admin and eDiscovery Admin roles..
 *
 * Maps to the official Miro endpoint DELETE /v2/orgs/{org_id}/cases/{case_id}.
 */
class MiroDeleteCase extends AbstractMiroTool
{
    protected const NAME = 'miro_delete_case';
    protected const DESCRIPTION = 'Closing a case is the final stage in the eDiscovery process, marking the conclusion of a legal matter or investigation. You must ensure that all associated legal holds within the case are closed before closing the case. Closing a case will permanently delete it. For more information, see our Help Center page on closing a case. This API closes a case in an organization. Required scope organization:cases:management Rate limiting Level 4 Enterprise Guard only This API is available only for Enterprise plan users with the Enterprise Guard add-on. You can only use this endpoint if you have both the Company Admin and eDiscovery Admin roles.

Official Miro endpoint: DELETE /v2/orgs/{org_id}/cases/{case_id}.';
    protected const PARAMETERS = array (
      'org_id' => array (
        'type' => 'string',
        'description' => 'The ID of the organization in which you want to close a case.',
        'required' => true,
      ),
      'case_id' => array (
        'type' => 'string',
        'description' => 'The ID of the case you want to close.',
        'required' => true,
      ),
    );
    protected const METHOD = 'DELETE';
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
