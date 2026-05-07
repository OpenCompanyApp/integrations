<?php

namespace OpenCompany\Integrations\SmartRecruiters\Tools;

/**
 * Get posting by posting id or uuid for given company.
 *
 * Maps to posting-api.json endpoint GET /v1/companies/{companyIdentifier}/postings/{postingId}.
 */
class SmartRecruitersPostingV1GetPosting extends AbstractSmartRecruitersTool
{
    protected const NAME = "smartrecruiters_posting_v1_get_posting";
    protected const DESCRIPTION = "Get posting by posting id or uuid for given company\n\nOfficial SmartRecruiters endpoint: GET /v1/companies/{companyIdentifier}/postings/{postingId} from posting-api.json.";
    protected const PARAMETERS = [
        "accept_language" => [
            "type" => "string",
            "enum" => [
                "af",
                "am",
                "ar",
                "az",
                "bg",
                "bn",
                "ca",
                "cs",
                "cy",
                "da",
                "de",
                "el",
                "en",
                "en-GB",
                "es",
                "es-MX",
                "et",
                "eu",
                "fa",
                "fi",
                "fil",
                "fr",
                "fr-CA",
                "ga",
                "gl",
                "gu",
                "he",
                "hi",
                "hr",
                "hu",
                "hy",
                "id",
                "is",
                "it",
                "ja",
                "ka",
                "km",
                "kn",
                "ko",
                "lo",
                "lt",
                "lv",
                "ml",
                "mn",
                "mr",
                "ms",
                "ne",
                "nl",
                "no",
                "pl",
                "pt",
                "pt-BR",
                "ro",
                "ru",
                "si",
                "sk",
                "sl",
                "sr",
                "sv",
                "sw",
                "ta",
                "te",
                "tr",
                "uk",
                "ur",
                "vi",
                "zh-CN",
                "zh-TW",
                "zu",
            ],
            "required" => false,
            "description" => "Language of translation",
        ],
        "company_identifier" => [
            "type" => "string",
            "required" => true,
            "description" => "Identifier of a company",
        ],
        "posting_id" => [
            "type" => "string",
            "required" => true,
            "description" => "Posting identifier or uuid",
        ],
        "source_type_id" => [
            "type" => "string",
            "required" => false,
            "description" => "sourceTypeId can be retrieved using endpoint. Used together with **sourceId** and **sourceSubTypeId** to add source tracking parameter to **applyUrl**.",
        ],
        "source_sub_type_id" => [
            "type" => "string",
            "required" => false,
            "description" => "sourceSubTypeId can be retrieved using endpoint. Used together with **sourceId** and **sourceTypeId** to add source tracking parameter to **applyUrl**.",
        ],
        "source_id" => [
            "type" => "string",
            "required" => false,
            "description" => "sourceId can be retrieved using endpoint. Used together with **sourceTypeId** and **sourceSubTypeId** to add source tracking parameter to **applyUrl**.",
        ],
    ];
    protected const METHOD = "GET";
    protected const BASE_URL = "https://api.smartrecruiters.com";
    protected const PATH = "/v1/companies/{companyIdentifier}/postings/{postingId}";
    protected const PATH_PARAMS = [
        "companyIdentifier" => "company_identifier",
        "postingId" => "posting_id",
    ];
    protected const QUERY_PARAMS = [
        "sourceTypeId" => "source_type_id",
        "sourceSubTypeId" => "source_sub_type_id",
        "sourceId" => "source_id",
    ];
    protected const HEADER_PARAMS = [
        "accept-language" => "accept_language",
    ];
    protected const QUERY_STYLES = [];
    protected const BODY_REQUIRED = false;
    protected const BODY_MODE = "json";
    protected const AUTH_MODE = "public";
}
