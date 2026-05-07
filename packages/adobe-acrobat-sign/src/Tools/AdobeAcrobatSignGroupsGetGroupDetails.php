<?php

namespace OpenCompany\Integrations\AdobeAcrobatSign\Tools;

/**
 * Retrieves detailed information about the group.
 *
 * Maps to the official Adobe Acrobat Sign endpoint get /groups/{groupId}.
 */
class AdobeAcrobatSignGroupsGetGroupDetails extends AbstractAdobeAcrobatSignTool
{
    protected const NAME = 'adobe_acrobat_sign_groups_get_group_details';
    protected const DESCRIPTION = 'Retrieves detailed information about the group.

Official Adobe Acrobat Sign endpoint: GET /groups/{groupId}

Retrieves detailed information about the group.';
    protected const PARAMETERS = array (
  'x_api_user' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'The userId or email of API caller using the account or group token in the format userid:{userId} OR email:{email}. If it is not specified, then the caller is inferred from the token.',
  ),
  'group_id' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'The group identifier, as returned by the group creation API or retrieved from the API to fetch groups',
  ),
);
    protected const METHOD = 'GET';
    protected const PATH = '/groups/{groupId}';
    protected const PATH_PARAMS = array (
  'groupId' => 'group_id',
);
    protected const QUERY_PARAMS = array (
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
