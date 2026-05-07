<?php

namespace OpenCompany\Integrations\ShipEngine\Tools;

/**
 * Create a New Tag.
 *
 * Maps to the official ShipEngine endpoint POST /v1/tags/{tag_name}.
 */
class ShipEngineCreateTag2 extends AbstractShipEngineTool
{
    protected const NAME = "shipengine_create_tag_2";
    protected const DESCRIPTION = "Create a New Tag\n\nOfficial ShipEngine endpoint: POST /v1/tags/{tag_name}.";
    protected const PARAMETERS = [
        "tag_name" => [
            "type" => "string",
            "required" => true,
            "description" => "Tags are arbitrary strings that you can use to categorize shipments. For example, you may want to use tags to distinguish between domestic and international shipments, or between insured and uninsured shipments. Or maybe you want to create a tag for each of your customers so you can easily retrieve every shipment for a customer.",
        ],
    ];
    protected const METHOD = "POST";
    protected const PATH = "/v1/tags/{tag_name}";
    protected const PATH_PARAMS = [
        "tag_name" => "tag_name",
    ];
    protected const QUERY_PARAMS = [];
    protected const HEADER_PARAMS = [];
    protected const QUERY_STYLES = [];
    protected const BODY_REQUIRED = false;
}
