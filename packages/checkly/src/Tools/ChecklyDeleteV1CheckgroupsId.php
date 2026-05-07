<?php

namespace OpenCompany\Integrations\Checkly\Tools;

/**
 * Permanently removes a check group. You cannot delete a check group if it still contains checks..
 *
 * Maps to the official Checkly endpoint DELETE /v1/check-groups/{id}.
 */
class ChecklyDeleteV1CheckgroupsId extends AbstractChecklyTool
{
    protected const NAME = 'checkly_delete_v1_checkgroups_id';
    protected const DESCRIPTION = 'Permanently removes a check group. You cannot delete a check group if it still contains checks.

Official Checkly endpoint: DELETE /v1/check-groups/{id}.';
    protected const PARAMETERS = array (
      'id' => array (
        'type' => 'integer',
        'description' => 'id parameter.',
        'required' => true,
      ),
    );
    protected const METHOD = 'DELETE';
    protected const PATH = '/v1/check-groups/{id}';
    protected const PATH_PARAMS = array (
      'id' => 'id',
    );
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}
