<?php

namespace OpenCompany\Integrations\Shippo\Tools;

/**
 * List all webhooks.
 *
 * Maps to the official Shippo endpoint GET /webhooks.
 */
class ShippoListWebhooks extends AbstractShippoTool
{
    protected const NAME = "shippo_list_webhooks";
    protected const DESCRIPTION = "List all webhooks\n\nOfficial Shippo endpoint: GET /webhooks.";
    protected const PARAMETERS = [];
    protected const METHOD = "GET";
    protected const PATH = "/webhooks";
    protected const PATH_PARAMS = [];
    protected const QUERY_PARAMS = [];
    protected const HEADER_PARAMS = [];
    protected const BODY_REQUIRED = false;
}
