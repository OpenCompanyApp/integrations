<?php

namespace OpenCompany\Integrations\ShipEngine\Tools;

/**
 * Get Bulk Rates.
 *
 * Maps to the official ShipEngine endpoint POST /v1/rates/bulk.
 */
class ShipEngineCompareBulkRates extends AbstractShipEngineTool
{
    protected const NAME = "shipengine_compare_bulk_rates";
    protected const DESCRIPTION = "Get Bulk Rates\n\nOfficial ShipEngine endpoint: POST /v1/rates/bulk.";
    protected const PARAMETERS = [
        "body" => [
            "type" => "object",
            "required" => true,
            "description" => "JSON request body matching the official ShipEngine schema for Get Bulk Rates.",
        ],
    ];
    protected const METHOD = "POST";
    protected const PATH = "/v1/rates/bulk";
    protected const PATH_PARAMS = [];
    protected const QUERY_PARAMS = [];
    protected const HEADER_PARAMS = [];
    protected const QUERY_STYLES = [];
    protected const BODY_REQUIRED = true;
}
