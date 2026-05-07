<?php

namespace OpenCompany\Integrations\Greenhouse\Tools;

/**
 * Delete Candidate Employments.
 *
 * Maps to the official Greenhouse Harvest v3 endpoint DELETE /v3/candidate_employments/{id}.
 */
class GreenhouseDeleteV3CandidateEmploymentsId extends AbstractGreenhouseTool
{
    protected const NAME = 'greenhouse_delete_v3_candidate_employments_id';
    protected const DESCRIPTION = 'Delete Candidate Employments

Official Greenhouse Harvest v3 endpoint: DELETE /v3/candidate_employments/{id}.';
    protected const PARAMETERS = [
        'id' => [
            'type' => 'string',
            'required' => true,
            'description' => 'path parameter `id`.',
        ],
    ];
    protected const METHOD = 'DELETE';
    protected const PATH = '/v3/candidate_employments/{id}';
    protected const PATH_PARAMS = [
        'id' => 'id',
    ];
    protected const QUERY_PARAMS = [];
    protected const HEADER_PARAMS = [];
    protected const QUERY_STYLES = [];
    protected const BODY_REQUIRED = false;
    protected const AUTH_MODE = 'bearer';
}
