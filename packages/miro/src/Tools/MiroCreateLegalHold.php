<?php

namespace OpenCompany\Integrations\Miro\Tools;

/**
 * After creating a case it is possible to add one or multiple legal holds to the case. Creating a legal hold involves identifying the relevant users associated with a case and applying the hold to prevent permanent deletion of content that those users own, co-own, create, edit or access. For more information, see our Help Center page on adding a legal hold to a case. This API creates a new legal hold in a case for an organization. Newly created legal holds could take up to 24 hours to be processed. Required scope organization:cases:management Rate limiting Level 4 Enterprise Guard only This API is available only for Enterprise plan users with the Enterprise Guard add-on. You can only use this endpoint if you have both the Company Admin and eDiscovery Admin roles..
 *
 * Maps to the official Miro endpoint POST /v2/orgs/{org_id}/cases/{case_id}/legal-holds.
 */
class MiroCreateLegalHold extends AbstractMiroTool
{
    protected const NAME = 'miro_create_legal_hold';
    protected const DESCRIPTION = 'After creating a case it is possible to add one or multiple legal holds to the case. Creating a legal hold involves identifying the relevant users associated with a case and applying the hold to prevent permanent deletion of content that those users own, co-own, create, edit or access. For more information, see our Help Center page on adding a legal hold to a case. This API creates a new legal hold in a case for an organization. Newly created legal holds could take up to 24 hours to be processed. Required scope organization:cases:management Rate limiting Level 4 Enterprise Guard only This API is available only for Enterprise plan users with the Enterprise Guard add-on. You can only use this endpoint if you have both the Company Admin and eDiscovery Admin roles.

Official Miro endpoint: POST /v2/orgs/{org_id}/cases/{case_id}/legal-holds.';
    protected const PARAMETERS = array (
      'org_id' => array (
        'type' => 'string',
        'description' => 'The ID of the organization in which you want to create a new legal hold.',
        'required' => true,
      ),
      'case_id' => array (
        'type' => 'string',
        'description' => 'The ID of the case in which you want to create a new legal hold.',
        'required' => true,
      ),
      'body' => array (
        'type' => 'object',
        'description' => 'Request body matching the Miro API schema.',
        'required' => true,
      ),
    );
    protected const METHOD = 'POST';
    protected const PATH = '/v2/orgs/{org_id}/cases/{case_id}/legal-holds';
    protected const PATH_PARAMS = array (
      'org_id' => 'org_id',
      'case_id' => 'case_id',
    );
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = true;
    protected const BODY_CONTENT_TYPE = 'application/json';
}
