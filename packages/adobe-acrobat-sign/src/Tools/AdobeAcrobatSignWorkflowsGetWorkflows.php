<?php

namespace OpenCompany\Integrations\AdobeAcrobatSign\Tools;

/**
 * Retrieves workflows for a user.
 *
 * Maps to the official Adobe Acrobat Sign endpoint get /workflows.
 */
class AdobeAcrobatSignWorkflowsGetWorkflows extends AbstractAdobeAcrobatSignTool
{
    protected const NAME = 'adobe_acrobat_sign_workflows_get_workflows';
    protected const DESCRIPTION = 'Retrieves workflows for a user.

Official Adobe Acrobat Sign endpoint: GET /workflows

Retrieves workflows for a user.';
    protected const PARAMETERS = array (
  'x_api_user' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'The userId or email of API caller using the account or group token in the format userid:{userId} OR email:{email}. If it is not specified, then the caller is inferred from the token.',
  ),
  'include_draft_workflows' =>
  array (
    'type' => 'boolean',
    'required' => false,
    'description' => 'Include draft workflows',
  ),
  'include_inactive_workflows' =>
  array (
    'type' => 'boolean',
    'required' => false,
    'description' => 'Include inactive workflows',
  ),
  'group_id' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'The group identifier for which the workflows will be fetched',
  ),
);
    protected const METHOD = 'GET';
    protected const PATH = '/workflows';
    protected const PATH_PARAMS = array (
);
    protected const QUERY_PARAMS = array (
  'includeDraftWorkflows' => 'include_draft_workflows',
  'includeInactiveWorkflows' => 'include_inactive_workflows',
  'groupId' => 'group_id',
);
    protected const HEADER_PARAMS = array (
  'x-api-user' => 'x_api_user',
);
    protected const FORM_PARAMS = array (
);
    protected const FILE_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}
