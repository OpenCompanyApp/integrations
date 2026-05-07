<?php

namespace OpenCompany\Integrations\ShipEngine\Tools;

/**
 * Parse an address.
 *
 * Maps to the official ShipEngine endpoint PUT /v1/addresses/recognize.
 */
class ShipEngineParseAddress extends AbstractShipEngineTool
{
    protected const NAME = "shipengine_parse_address";
    protected const DESCRIPTION = "Parse an address\n\nOfficial ShipEngine endpoint: PUT /v1/addresses/recognize.";
    protected const PARAMETERS = [
        "body" => [
            "type" => "object",
            "required" => true,
            "description" => "The only required field is text, which is the text to be parsed. You can optionally also provide an address containing already-known values. For example, you may already know the recipient's name, city, and country, and only want to parse the street address into separate lines.",
        ],
    ];
    protected const METHOD = "PUT";
    protected const PATH = "/v1/addresses/recognize";
    protected const PATH_PARAMS = [];
    protected const QUERY_PARAMS = [];
    protected const HEADER_PARAMS = [];
    protected const QUERY_STYLES = [];
    protected const BODY_REQUIRED = true;
}
