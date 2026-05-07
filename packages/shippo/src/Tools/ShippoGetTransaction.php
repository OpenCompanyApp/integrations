<?php

namespace OpenCompany\Integrations\Shippo\Tools;

/**
 * Retrieve a shipping label.
 *
 * Maps to the official Shippo endpoint GET /transactions/{TransactionId}.
 */
class ShippoGetTransaction extends AbstractShippoTool
{
    protected const NAME = "shippo_get_transaction";
    protected const DESCRIPTION = "Retrieve a shipping label\n\nOfficial Shippo endpoint: GET /transactions/{TransactionId}.";
    protected const PARAMETERS = [
        "transaction_id" => [
            "type" => "string",
            "required" => true,
            "description" => "Object ID of the transaction to update",
        ],
        "shippo_api_version" => [
            "type" => "string",
            "required" => false,
            "description" => "Optional string used to pick a non-default API version to use. See our API version guide.",
        ],
    ];
    protected const METHOD = "GET";
    protected const PATH = "/transactions/{TransactionId}";
    protected const PATH_PARAMS = [
        "TransactionId" => "transaction_id",
    ];
    protected const QUERY_PARAMS = [];
    protected const HEADER_PARAMS = [
        "SHIPPO-API-VERSION" => "shippo_api_version",
    ];
    protected const BODY_REQUIRED = false;
}
