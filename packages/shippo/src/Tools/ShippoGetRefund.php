<?php

namespace OpenCompany\Integrations\Shippo\Tools;

/**
 * Retrieve a refund.
 *
 * Maps to the official Shippo endpoint GET /refunds/{RefundId}.
 */
class ShippoGetRefund extends AbstractShippoTool
{
    protected const NAME = "shippo_get_refund";
    protected const DESCRIPTION = "Retrieve a refund\n\nOfficial Shippo endpoint: GET /refunds/{RefundId}.";
    protected const PARAMETERS = [
        "refund_id" => [
            "type" => "string",
            "required" => true,
            "description" => "Object ID of the refund to update",
        ],
        "shippo_api_version" => [
            "type" => "string",
            "required" => false,
            "description" => "Optional string used to pick a non-default API version to use. See our API version guide.",
        ],
    ];
    protected const METHOD = "GET";
    protected const PATH = "/refunds/{RefundId}";
    protected const PATH_PARAMS = [
        "RefundId" => "refund_id",
    ];
    protected const QUERY_PARAMS = [];
    protected const HEADER_PARAMS = [
        "SHIPPO-API-VERSION" => "shippo_api_version",
    ];
    protected const BODY_REQUIRED = false;
}
