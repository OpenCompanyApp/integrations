<?php

namespace OpenCompany\Integrations\ShipEngine\Tools;

/**
 * List Account Settings.
 *
 * Maps to the official ShipEngine endpoint GET /v1/account/settings.
 */
class ShipEngineListAccountSettings extends AbstractShipEngineTool
{
    protected const NAME = "shipengine_list_account_settings";
    protected const DESCRIPTION = "List Account Settings\n\nOfficial ShipEngine endpoint: GET /v1/account/settings.";
    protected const PARAMETERS = [];
    protected const METHOD = "GET";
    protected const PATH = "/v1/account/settings";
    protected const PATH_PARAMS = [];
    protected const QUERY_PARAMS = [];
    protected const HEADER_PARAMS = [];
    protected const QUERY_STYLES = [];
    protected const BODY_REQUIRED = false;
}
