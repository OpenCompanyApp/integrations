<?php

namespace OpenCompany\Integrations\Miro\Tools;

/**
 * Editing a case allows eDiscovery Admins to keep case details accurate and aligned with the evolving scope of a legal matter. As investigations progress, it may be necessary to update the case name or description to reflect changes in focus, terminology, or internal documentation standards. Since a case serves as the central container for one or more legal holds, keeping its information up to date helps ensure clarity, consistency, and easier navigation for all stakeholders involved in the legal process. Required scope organization:cases:management Rate limiting Level 3 Enterprise Guard only This API is available only for Enterprise plan users with the Enterprise Guard add-on. You can only use this endpoint if you have both the Company Admin and eDiscovery Admin roles..
 *
 * Maps to the official Miro endpoint PUT /v2/orgs/{org_id}/cases/{case_id}.
 */
class MiroEditCase extends AbstractMiroTool
{
    protected const NAME = 'miro_edit_case';
    protected const DESCRIPTION = 'Editing a case allows eDiscovery Admins to keep case details accurate and aligned with the evolving scope of a legal matter. As investigations progress, it may be necessary to update the case name or description to reflect changes in focus, terminology, or internal documentation standards. Since a case serves as the central container for one or more legal holds, keeping its information up to date helps ensure clarity, consistency, and easier navigation for all stakeholders involved in the legal process. Required scope organization:cases:management Rate limiting Level 3 Enterprise Guard only This API is available only for Enterprise plan users with the Enterprise Guard add-on. You can only use this endpoint if you have both the Company Admin and eDiscovery Admin roles.

Official Miro endpoint: PUT /v2/orgs/{org_id}/cases/{case_id}.';
    protected const PARAMETERS = array (
      'org_id' => array (
        'type' => 'string',
        'description' => 'The ID of the organization for which you want to edit the case information.',
        'required' => true,
      ),
      'case_id' => array (
        'type' => 'string',
        'description' => 'The ID of the case you want to edit.',
        'required' => true,
      ),
      'body' => array (
        'type' => 'object',
        'description' => 'Request body matching the Miro API schema.',
        'required' => true,
      ),
    );
    protected const METHOD = 'PUT';
    protected const PATH = '/v2/orgs/{org_id}/cases/{case_id}';
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
