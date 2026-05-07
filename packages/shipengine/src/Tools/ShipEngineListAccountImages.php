<?php

namespace OpenCompany\Integrations\ShipEngine\Tools;

/**
 * List Account Images.
 *
 * Maps to the official ShipEngine endpoint GET /v1/account/settings/images.
 */
class ShipEngineListAccountImages extends AbstractShipEngineTool
{
    protected const NAME = "shipengine_list_account_images";
    protected const DESCRIPTION = "List Account Images\n\nOfficial ShipEngine endpoint: GET /v1/account/settings/images.";
    protected const PARAMETERS = [];
    protected const METHOD = "GET";
    protected const PATH = "/v1/account/settings/images";
    protected const PATH_PARAMS = [];
    protected const QUERY_PARAMS = [];
    protected const HEADER_PARAMS = [];
    protected const QUERY_STYLES = [];
    protected const BODY_REQUIRED = false;
}
