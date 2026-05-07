<?php

namespace OpenCompany\Integrations\Dwolla\Tools;

/**
 * Verify KBA Questions.
 *
 * Maps to the official Dwolla endpoint POST /kba/{id}.
 */
class DwollaVerifyKbaQuestions extends AbstractDwollaTool
{
    protected const NAME = 'dwolla_verify_kba_questions';
    protected const DESCRIPTION = 'Submits customer answers to KBA questions for identity verification. Requires four question-answer pairs with questionId and answerId values. Returns verification status indicating whether the customer passed or failed the KBA authentication.

Official Dwolla endpoint: POST /kba/{id}.';
    protected const PARAMETERS = [
        'id' => [
            'type' => 'string',
            'required' => true,
            'description' => 'The id of the KBA session to verify questions for.',
        ],
        'accept' => [
            'type' => 'string',
            'required' => true,
            'description' => 'The media type of the response. Must be application/vnd.dwolla.v1.hal+json',
            'enum' => ['application/vnd.dwolla.v1.hal+json'],
        ],
        'body' => [
            'type' => 'object',
            'required' => true,
            'description' => 'Request body matching the official Dwolla OpenAPI schema.',
        ],
    ];
    protected const METHOD = 'POST';
    protected const PATH = '/kba/{id}';
    protected const PATH_PARAMS = [
        'id' => 'id',
    ];
    protected const QUERY_PARAMS = [];
    protected const HEADER_PARAMS = [
        'Accept' => 'accept',
    ];
    protected const BODY_REQUIRED = true;
    protected const BODY_CONTENT_TYPE = 'application/json';
    protected const AUTH_MODE = 'bearer';
}
