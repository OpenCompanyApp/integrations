<?php

namespace OpenCompany\Integrations\ShipEngine\Tools;

/**
 * Cancel a Shipment.
 *
 * Maps to the official ShipEngine endpoint PUT /v1/shipments/{shipment_id}/cancel.
 */
class ShipEngineCancelShipments extends AbstractShipEngineTool
{
    protected const NAME = "shipengine_cancel_shipments";
    protected const DESCRIPTION = "Cancel a Shipment\n\nOfficial ShipEngine endpoint: PUT /v1/shipments/{shipment_id}/cancel.";
    protected const PARAMETERS = [
        "shipment_id" => [
            "type" => "string",
            "required" => true,
            "description" => "Shipment ID",
        ],
    ];
    protected const METHOD = "PUT";
    protected const PATH = "/v1/shipments/{shipment_id}/cancel";
    protected const PATH_PARAMS = [
        "shipment_id" => "shipment_id",
    ];
    protected const QUERY_PARAMS = [];
    protected const HEADER_PARAMS = [];
    protected const QUERY_STYLES = [];
    protected const BODY_REQUIRED = false;
}
