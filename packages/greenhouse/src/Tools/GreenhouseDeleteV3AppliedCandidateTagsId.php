<?php

namespace OpenCompany\Integrations\Greenhouse\Tools;

/**
 * Delete Applied Candidate Tag.
 *
 * Maps to the official Greenhouse Harvest v3 endpoint DELETE /v3/applied_candidate_tags/{id}.
 */
class GreenhouseDeleteV3AppliedCandidateTagsId extends AbstractGreenhouseTool
{
    protected const NAME = 'greenhouse_delete_v3_applied_candidate_tags_id';
    protected const DESCRIPTION = 'Delete Applied Candidate Tag

Official Greenhouse Harvest v3 endpoint: DELETE /v3/applied_candidate_tags/{id}.';
    protected const PARAMETERS = [
        'id' => [
            'type' => 'string',
            'required' => true,
            'description' => 'path parameter `id`.',
        ],
    ];
    protected const METHOD = 'DELETE';
    protected const PATH = '/v3/applied_candidate_tags/{id}';
    protected const PATH_PARAMS = [
        'id' => 'id',
    ];
    protected const QUERY_PARAMS = [];
    protected const HEADER_PARAMS = [];
    protected const QUERY_STYLES = [];
    protected const BODY_REQUIRED = false;
    protected const AUTH_MODE = 'bearer';
}
