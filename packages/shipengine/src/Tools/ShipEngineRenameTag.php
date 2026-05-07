<?php

namespace OpenCompany\Integrations\ShipEngine\Tools;

/**
 * Update Tag Name.
 *
 * Maps to the official ShipEngine endpoint PUT /v1/tags/{tag_name}/{new_tag_name}.
 */
class ShipEngineRenameTag extends AbstractShipEngineTool
{
    protected const NAME = "shipengine_rename_tag";
    protected const DESCRIPTION = "Update Tag Name\n\nOfficial ShipEngine endpoint: PUT /v1/tags/{tag_name}/{new_tag_name}.";
    protected const PARAMETERS = [
        "tag_name" => [
            "type" => "string",
            "required" => true,
            "description" => "Tags are arbitrary strings that you can use to categorize shipments. For example, you may want to use tags to distinguish between domestic and international shipments, or between insured and uninsured shipments. Or maybe you want to create a tag for each of your customers so you can easily retrieve every shipment for a customer.",
        ],
        "new_tag_name" => [
            "type" => "string",
            "required" => true,
            "description" => "Tags are arbitrary strings that you can use to categorize shipments. For example, you may want to use tags to distinguish between domestic and international shipments, or between insured and uninsured shipments. Or maybe you want to create a tag for each of your customers so you can easily retrieve every shipment for a customer.",
        ],
    ];
    protected const METHOD = "PUT";
    protected const PATH = "/v1/tags/{tag_name}/{new_tag_name}";
    protected const PATH_PARAMS = [
        "tag_name" => "tag_name",
        "new_tag_name" => "new_tag_name",
    ];
    protected const QUERY_PARAMS = [];
    protected const HEADER_PARAMS = [];
    protected const QUERY_STYLES = [];
    protected const BODY_REQUIRED = false;
}
