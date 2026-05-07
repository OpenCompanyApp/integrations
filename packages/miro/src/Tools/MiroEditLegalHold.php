<?php

namespace OpenCompany\Integrations\Miro\Tools;

/**
 * Editing a legal hold allows eDiscovery Admins to adjust and refine ongoing legal preservation efforts as case requirements evolve. Whether new custodians are identified, additional Miro boards become relevant, or existing boards or users are no longer in scope, editing a legal hold ensures that the correct data remains preserved and defensible throughout the legal process. Admins can update the legal hold’s name or description and add or remove users and boards as needed. This flexibility supports dynamic legal workflows and ensures that preservation stays precise, up to date, and aligned with the scope of the legal matter—maintaining compliance while avoiding unnecessary data retention. When a legal hold is edited, boards newly added to the hold will begin having their versions preserved from that point forward, boards or users removed from the hold will stop being preserved, and their versions will no longer be preserved as part of that legal hold, boards that remain under hold will continue to have all versions preserved, including any deletions that occur after the hold was applied. This approach ensures organizations can respond to legal demands with accuracy and accountability as a case evolves. Required scope organization:cases:management Rate limiting Level 3 Enterprise Guard only This API is available only for Enterprise plan users with the Enterprise Guard add-on. You can only use this endpoint if you have both the Company Admin and eDiscovery Admin roles..
 *
 * Maps to the official Miro endpoint PUT /v2/orgs/{org_id}/cases/{case_id}/legal-holds/{legal_hold_id}.
 */
class MiroEditLegalHold extends AbstractMiroTool
{
    protected const NAME = 'miro_edit_legal_hold';
    protected const DESCRIPTION = 'Editing a legal hold allows eDiscovery Admins to adjust and refine ongoing legal preservation efforts as case requirements evolve. Whether new custodians are identified, additional Miro boards become relevant, or existing boards or users are no longer in scope, editing a legal hold ensures that the correct data remains preserved and defensible throughout the legal process. Admins can update the legal hold’s name or description and add or remove users and boards as needed. This flexibility supports dynamic legal workflows and ensures that preservation stays precise, up to date, and aligned with the scope of the legal matter—maintaining compliance while avoiding unnecessary data retention. When a legal hold is edited, boards newly added to the hold will begin having their versions preserved from that point forward, boards or users removed from the hold will stop being preserved, and their versions will no longer be preserved as part of that legal hold, boards that remain under hold will continue to have all versions preserved, including any deletions that occur after the hold was applied. This approach ensures organizations can respond to legal demands with accuracy and accountability as a case evolves. Required scope organization:cases:management Rate limiting Level 3 Enterprise Guard only This API is available only for Enterprise plan users with the Enterprise Guard add-on. You can only use this endpoint if you have both the Company Admin and eDiscovery Admin roles.

Official Miro endpoint: PUT /v2/orgs/{org_id}/cases/{case_id}/legal-holds/{legal_hold_id}.';
    protected const PARAMETERS = array (
      'org_id' => array (
        'type' => 'string',
        'description' => 'The ID of the organization for which you want to edit the legal hold information.',
        'required' => true,
      ),
      'case_id' => array (
        'type' => 'string',
        'description' => 'The ID of the case for which you want to edit the legal hold information.',
        'required' => true,
      ),
      'legal_hold_id' => array (
        'type' => 'string',
        'description' => 'The ID of the legal hold you want to edit.',
        'required' => true,
      ),
      'body' => array (
        'type' => 'object',
        'description' => 'Request body matching the Miro API schema.',
        'required' => true,
      ),
    );
    protected const METHOD = 'PUT';
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
    protected const BODY_REQUIRED = true;
    protected const BODY_CONTENT_TYPE = 'application/json';
}
