<?php

namespace OpenCompany\Integrations\Checkly\Tools;

/**
 * Asynchronously generates a root cause analysis for a specific check error group. Returns an `id` which you can use to poll the `/root-cause-analyses/{id}` endpoint..
 *
 * Maps to the official Checkly endpoint POST /v1/root-cause-analyses/error-groups/{errorGroupId}.
 */
class ChecklyPostV1RootcauseanalysesErrorgroupsErrorgroupid extends AbstractChecklyTool
{
    protected const NAME = 'checkly_post_v1_rootcauseanalyses_errorgroups_errorgroupid';
    protected const DESCRIPTION = 'Asynchronously generates a root cause analysis for a specific check error group. Returns an `id` which you can use to poll the `/root-cause-analyses/{id}` endpoint.

Official Checkly endpoint: POST /v1/root-cause-analyses/error-groups/{errorGroupId}.';
    protected const PARAMETERS = array (
      'error_group_id' => array (
        'type' => 'string',
        'description' => 'errorGroupId parameter.',
        'required' => true,
      ),
      'body' => array (
        'type' => 'object',
        'description' => 'JSON request body matching the Checkly API schema.',
        'required' => false,
      ),
    );
    protected const METHOD = 'POST';
    protected const PATH = '/v1/root-cause-analyses/error-groups/{errorGroupId}';
    protected const PATH_PARAMS = array (
      'errorGroupId' => 'error_group_id',
    );
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}
