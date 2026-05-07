<?php

namespace OpenCompany\Integrations\ShipEngine\Tools;

/**
 * Get Shipment By External ID.
 *
 * Maps to the official ShipEngine endpoint GET /v1/shipments/external_shipment_id/{external_shipment_id}.
 */
class ShipEngineGetShipmentByExternalId extends AbstractShipEngineTool
{
    protected const NAME = "shipengine_get_shipment_by_external_id";
    protected const DESCRIPTION = "Get Shipment By External ID\n\nOfficial ShipEngine endpoint: GET /v1/shipments/external_shipment_id/{external_shipment_id}.";
    protected const PARAMETERS = [
        "external_shipment_id" => [
            "type" => "string",
            "required" => true,
            "description" => "path parameter `external_shipment_id`.",
        ],
    ];
    protected const METHOD = "GET";
    protected const PATH = "/v1/shipments/external_shipment_id/{external_shipment_id}";
    protected const PATH_PARAMS = [
        "external_shipment_id" => "external_shipment_id",
    ];
    protected const QUERY_PARAMS = [];
    protected const HEADER_PARAMS = [];
    protected const QUERY_STYLES = [];
    protected const BODY_REQUIRED = false;
}
