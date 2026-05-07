<?php

namespace OpenCompany\Integrations\SmartRecruiters\Tools;

/**
 * Shorten URL.
 *
 * Maps to url-shortener.json endpoint POST /shorten.
 */
class SmartRecruitersUrlShortenerPublicShorten extends AbstractSmartRecruitersTool
{
    protected const NAME = "smartrecruiters_url_shortener_public_shorten";
    protected const DESCRIPTION = "Shorten URL\n\nOfficial SmartRecruiters endpoint: POST /shorten from url-shortener.json.";
    protected const PARAMETERS = [
        "body" => [
            "type" => "object",
            "required" => true,
            "description" => "Request body matching the official SmartRecruiters url-shortener.json schema for Shorten URL.",
        ],
    ];
    protected const METHOD = "POST";
    protected const BASE_URL = "https://api.smartrecruiters.com/url-shortener";
    protected const PATH = "/shorten";
    protected const PATH_PARAMS = [];
    protected const QUERY_PARAMS = [];
    protected const HEADER_PARAMS = [];
    protected const QUERY_STYLES = [];
    protected const BODY_REQUIRED = true;
    protected const BODY_MODE = "json";
    protected const AUTH_MODE = "either";
}
