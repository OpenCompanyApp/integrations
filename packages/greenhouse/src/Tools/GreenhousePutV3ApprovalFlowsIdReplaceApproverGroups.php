<?php

namespace OpenCompany\Integrations\Greenhouse\Tools;

/**
 * Replace Approver Groups.
 *
 * Maps to the official Greenhouse Harvest v3 endpoint PUT /v3/approval_flows/{id}/replace_approver_groups.
 */
class GreenhousePutV3ApprovalFlowsIdReplaceApproverGroups extends AbstractGreenhouseTool
{
    protected const NAME = 'greenhouse_put_v3_approval_flows_id_replace_approver_groups';
    protected const DESCRIPTION = 'Replace Approver Groups

Official Greenhouse Harvest v3 endpoint: PUT /v3/approval_flows/{id}/replace_approver_groups.';
    protected const PARAMETERS = [
        'id' => [
            'type' => 'integer',
            'required' => true,
            'description' => 'path parameter `id`.',
        ],
        'body' => [
            'type' => 'object',
            'required' => true,
            'description' => 'JSON request body matching the official Greenhouse Harvest v3 schema for this operation.',
        ],
    ];
    protected const METHOD = 'PUT';
    protected const PATH = '/v3/approval_flows/{id}/replace_approver_groups';
    protected const PATH_PARAMS = [
        'id' => 'id',
    ];
    protected const QUERY_PARAMS = [];
    protected const HEADER_PARAMS = [];
    protected const QUERY_STYLES = [];
    protected const BODY_REQUIRED = true;
    protected const AUTH_MODE = 'bearer';
}
