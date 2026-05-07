<?php

namespace OpenCompany\Integrations\Greenhouse\Tools;

/**
 * Updates scorecard candidate attributes - **restricted**.
 *
 * Maps to the official Greenhouse Harvest v3 endpoint PATCH /v3/scorecard_candidate_attributes/{id}.
 */
class GreenhousePatchV3ScorecardCandidateAttributesId extends AbstractGreenhouseTool
{
    protected const NAME = 'greenhouse_patch_v3_scorecard_candidate_attributes_id';
    protected const DESCRIPTION = 'Updates scorecard candidate attributes - **restricted**

Official Greenhouse Harvest v3 endpoint: PATCH /v3/scorecard_candidate_attributes/{id}.';
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
    protected const METHOD = 'PATCH';
    protected const PATH = '/v3/scorecard_candidate_attributes/{id}';
    protected const PATH_PARAMS = [
        'id' => 'id',
    ];
    protected const QUERY_PARAMS = [];
    protected const HEADER_PARAMS = [];
    protected const QUERY_STYLES = [];
    protected const BODY_REQUIRED = true;
    protected const AUTH_MODE = 'bearer';
}
