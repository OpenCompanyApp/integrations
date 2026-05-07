<?php

namespace OpenCompany\Integrations\Greenhouse\Tools;

/**
 * Create scorecard candidate attributes - **restricted**.
 *
 * Maps to the official Greenhouse Harvest v3 endpoint POST /v3/scorecard_candidate_attributes.
 */
class GreenhousePostV3ScorecardCandidateAttributes extends AbstractGreenhouseTool
{
    protected const NAME = 'greenhouse_post_v3_scorecard_candidate_attributes';
    protected const DESCRIPTION = 'Create scorecard candidate attributes - **restricted**

Official Greenhouse Harvest v3 endpoint: POST /v3/scorecard_candidate_attributes.';
    protected const PARAMETERS = [
        'body' => [
            'type' => 'object',
            'required' => true,
            'description' => 'JSON request body matching the official Greenhouse Harvest v3 schema for this operation.',
        ],
    ];
    protected const METHOD = 'POST';
    protected const PATH = '/v3/scorecard_candidate_attributes';
    protected const PATH_PARAMS = [];
    protected const QUERY_PARAMS = [];
    protected const HEADER_PARAMS = [];
    protected const QUERY_STYLES = [];
    protected const BODY_REQUIRED = true;
    protected const AUTH_MODE = 'bearer';
}
