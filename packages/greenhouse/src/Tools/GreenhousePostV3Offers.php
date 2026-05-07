<?php

namespace OpenCompany\Integrations\Greenhouse\Tools;

/**
 * Create Offer.
 *
 * Maps to the official Greenhouse Harvest v3 endpoint POST /v3/offers.
 */
class GreenhousePostV3Offers extends AbstractGreenhouseTool
{
    protected const NAME = 'greenhouse_post_v3_offers';
    protected const DESCRIPTION = 'Create Offer

Official Greenhouse Harvest v3 endpoint: POST /v3/offers.';
    protected const PARAMETERS = [
        'body' => [
            'type' => 'object',
            'required' => true,
            'description' => 'JSON request body matching the official Greenhouse Harvest v3 schema for this operation.',
        ],
    ];
    protected const METHOD = 'POST';
    protected const PATH = '/v3/offers';
    protected const PATH_PARAMS = [];
    protected const QUERY_PARAMS = [];
    protected const HEADER_PARAMS = [];
    protected const QUERY_STYLES = [];
    protected const BODY_REQUIRED = true;
    protected const AUTH_MODE = 'bearer';
}
