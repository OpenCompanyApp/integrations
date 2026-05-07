<?php

namespace OpenCompany\Integrations\Dwolla\Tools;

/**
 * Retrieve KBA Questions.
 *
 * Maps to the official Dwolla endpoint GET /kba/{id}.
 */
class DwollaGetKbaQuestions extends AbstractDwollaTool
{
    protected const NAME = 'dwolla_get_kba_questions';
    protected const DESCRIPTION = 'Returns the KBA questions for a specific KBA session. The questions are used to verify the customer\'s identity during the KBA process.

Official Dwolla endpoint: GET /kba/{id}.';
    protected const PARAMETERS = [
        'id' => [
            'type' => 'string',
            'required' => true,
            'description' => 'The ID of the KBA session to retrieve questions for',
        ],
        'accept' => [
            'type' => 'string',
            'required' => true,
            'description' => 'The media type of the response. Must be application/vnd.dwolla.v1.hal+json',
            'enum' => ['application/vnd.dwolla.v1.hal+json'],
        ],
    ];
    protected const METHOD = 'GET';
    protected const PATH = '/kba/{id}';
    protected const PATH_PARAMS = [
        'id' => 'id',
    ];
    protected const QUERY_PARAMS = [];
    protected const HEADER_PARAMS = [
        'Accept' => 'accept',
    ];
    protected const BODY_REQUIRED = false;
    protected const BODY_CONTENT_TYPE = 'application/json';
    protected const AUTH_MODE = 'bearer';
}
