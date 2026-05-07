<?php

namespace OpenCompany\Integrations\Miro\Tools;

/**
 * Closing a legal hold is one of the final steps in the eDiscovery process once the litigation or investigation has concluded. This process involves releasing the Miro boards and custodians that were under legal hold, allowing the preserved boards to return to normal operations. Closing a legal hold will permanently delete it. For more information, see our Help Center page on closing a legal hold. This API closes a legal hold in a case for an organization. Once a legal hold is closed, it can take up to 24 hours to release the content items from the legal hold. Required scope organization:cases:management Rate limiting Level 4 Enterprise Guard only This API is available only for Enterprise plan users with the Enterprise Guard add-on. You can only use this endpoint if you have both the Company Admin and eDiscovery Admin roles..
 *
 * Maps to the official Miro endpoint DELETE /v2/orgs/{org_id}/cases/{case_id}/legal-holds/{legal_hold_id}.
 */
class MiroDeleteLegalHold extends AbstractMiroTool
{
    protected const NAME = 'miro_delete_legal_hold';
    protected const DESCRIPTION = 'Closing a legal hold is one of the final steps in the eDiscovery process once the litigation or investigation has concluded. This process involves releasing the Miro boards and custodians that were under legal hold, allowing the preserved boards to return to normal operations. Closing a legal hold will permanently delete it. For more information, see our Help Center page on closing a legal hold. This API closes a legal hold in a case for an organization. Once a legal hold is closed, it can take up to 24 hours to release the content items from the legal hold. Required scope organization:cases:management Rate limiting Level 4 Enterprise Guard only This API is available only for Enterprise plan users with the Enterprise Guard add-on. You can only use this endpoint if you have both the Company Admin and eDiscovery Admin roles.

Official Miro endpoint: DELETE /v2/orgs/{org_id}/cases/{case_id}/legal-holds/{legal_hold_id}.';
    protected const PARAMETERS = array (
      'org_id' => array (
        'type' => 'string',
        'description' => 'The ID of the organization in which you want to close a legal hold.',
        'required' => true,
      ),
      'case_id' => array (
        'type' => 'string',
        'description' => 'The ID of the case in which you want to close a legal hold.',
        'required' => true,
      ),
      'legal_hold_id' => array (
        'type' => 'string',
        'description' => 'The ID of the legal hold you want to close.',
        'required' => true,
      ),
    );
    protected const METHOD = 'DELETE';
    protected const PATH = '/v2/orgs/{org_id}/cases/{case_id}/legal-holds/{legal_hold_id}';
    protected const PATH_PARAMS = array (
      'org_id' => 'org_id',
      'case_id' => 'case_id',
      'legal_hold_id' => 'legal_hold_id',
    );
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
    protected const BODY_CONTENT_TYPE = 'application/json';
}
