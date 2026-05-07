<?php

namespace OpenCompany\Integrations\ShipEngine\Tools;

/**
 * List Custom Package Types.
 *
 * Maps to the official ShipEngine endpoint GET /v1/packages.
 */
class ShipEngineListPackageTypes extends AbstractShipEngineTool
{
    protected const NAME = "shipengine_list_package_types";
    protected const DESCRIPTION = "List Custom Package Types\n\nOfficial ShipEngine endpoint: GET /v1/packages.";
    protected const PARAMETERS = [];
    protected const METHOD = "GET";
    protected const PATH = "/v1/packages";
    protected const PATH_PARAMS = [];
    protected const QUERY_PARAMS = [];
    protected const HEADER_PARAMS = [];
    protected const QUERY_STYLES = [];
    protected const BODY_REQUIRED = false;
}
