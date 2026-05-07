<?php

namespace OpenCompany\Integrations\SmartRecruiters\Tools;

/**
 * Get a list of available offer properties.
 *
 * Maps to configuration-api.json endpoint GET /configuration/offer-properties.
 */
class SmartRecruitersConfigurationConfigurationOfferPropertiesAll extends AbstractSmartRecruitersTool
{
    protected const NAME = "smartrecruiters_configuration_configuration_offer_properties_all";
    protected const DESCRIPTION = "Get a list of available offer properties\n\nOfficial SmartRecruiters endpoint: GET /configuration/offer-properties from configuration-api.json.";
    protected const PARAMETERS = [];
    protected const METHOD = "GET";
    protected const BASE_URL = "https://api.smartrecruiters.com";
    protected const PATH = "/configuration/offer-properties";
    protected const PATH_PARAMS = [];
    protected const QUERY_PARAMS = [];
    protected const HEADER_PARAMS = [];
    protected const QUERY_STYLES = [];
    protected const BODY_REQUIRED = false;
    protected const BODY_MODE = "json";
    protected const AUTH_MODE = "either";
}
