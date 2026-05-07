<?php

namespace OpenCompany\Integrations\Miro\Tools;

/**
 * Once a legal hold is in place you can review or explore the preserved Miro boards to ensure that all relevant data is intact and ready for legal proceedings or investigations. For more information, see our Help Center page on reviewing boards under legal hold. This API lists all content items under a specific legal hold in a case for an organization. Please verify that the legal hold is in 'ACTIVE' state to guarantee that the legal hold has finished processing the full list of content items under hold. Required scope organization:cases:management Rate limiting Level 3 Enterprise Guard only This API is available only for Enterprise plan users with the Enterprise Guard add-on. You can only use this endpoint if you have both the Company Admin and eDiscovery Admin roles..
 *
 * Maps to the official Miro endpoint GET /v2/orgs/{org_id}/cases/{case_id}/legal-holds/{legal_hold_id}/content-items.
 */
class MiroGetLegalHoldContentItems extends AbstractMiroTool
{
    protected const NAME = 'miro_get_legal_hold_content_items';
    protected const DESCRIPTION = 'Once a legal hold is in place you can review or explore the preserved Miro boards to ensure that all relevant data is intact and ready for legal proceedings or investigations. For more information, see our Help Center page on reviewing boards under legal hold. This API lists all content items under a specific legal hold in a case for an organization. Please verify that the legal hold is in \'ACTIVE\' state to guarantee that the legal hold has finished processing the full list of content items under hold. Required scope organization:cases:management Rate limiting Level 3 Enterprise Guard only This API is available only for Enterprise plan users with the Enterprise Guard add-on. You can only use this endpoint if you have both the Company Admin and eDiscovery Admin roles.

Official Miro endpoint: GET /v2/orgs/{org_id}/cases/{case_id}/legal-holds/{legal_hold_id}/content-items.';
    protected const PARAMETERS = array (
      'org_id' => array (
        'type' => 'string',
        'description' => 'The ID of the organization for which you want to retrieve the list of content items under hold.',
        'required' => true,
      ),
      'case_id' => array (
        'type' => 'string',
        'description' => 'The ID of the case for which you want to retrieve the list of content items under hold.',
        'required' => true,
      ),
      'legal_hold_id' => array (
        'type' => 'string',
        'description' => 'The ID of the legal hold for which you want to retrieve the list of content items under hold.',
        'required' => true,
      ),
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
    );
    protected const METHOD = 'GET';
    protected const PATH = '/v2/orgs/{org_id}/cases/{case_id}/legal-holds/{legal_hold_id}/content-items';
    protected const PATH_PARAMS = array (
      'org_id' => 'org_id',
      'case_id' => 'case_id',
      'legal_hold_id' => 'legal_hold_id',
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
