<?php

namespace OpenCompany\Integrations\ShipEngine\Tools;

/**
 * Cancel a label refund request.
 *
 * Maps to the official ShipEngine endpoint POST /v1/labels/{label_id}/cancel_refund.
 */
class ShipEngineCancelLabelRefund extends AbstractShipEngineTool
{
    protected const NAME = "shipengine_cancel_label_refund";
    protected const DESCRIPTION = "Cancel a label refund request\n\nOfficial ShipEngine endpoint: POST /v1/labels/{label_id}/cancel_refund.";
    protected const PARAMETERS = [
        "label_id" => [
            "type" => "string",
            "required" => true,
            "description" => "Label ID",
        ],
    ];
    protected const METHOD = "POST";
    protected const PATH = "/v1/labels/{label_id}/cancel_refund";
    protected const PATH_PARAMS = [
        "label_id" => "label_id",
    ];
    protected const QUERY_PARAMS = [];
    protected const HEADER_PARAMS = [];
    protected const QUERY_STYLES = [];
    protected const BODY_REQUIRED = false;
}
