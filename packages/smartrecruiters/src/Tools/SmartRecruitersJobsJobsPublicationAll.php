<?php

namespace OpenCompany\Integrations\SmartRecruiters\Tools;

/**
 * Find and list publications for a job.
 *
 * Maps to jobs-api.json endpoint GET /jobs/{jobId}/publication.
 */
class SmartRecruitersJobsJobsPublicationAll extends AbstractSmartRecruitersTool
{
    protected const NAME = "smartrecruiters_jobs_jobs_publication_all";
    protected const DESCRIPTION = "Find and list publications for a job\n\nOfficial SmartRecruiters endpoint: GET /jobs/{jobId}/publication from jobs-api.json.";
    protected const PARAMETERS = [
        "job_id" => [
            "type" => "string",
            "required" => true,
            "description" => "job identifier",
        ],
        "accept_language" => [
            "type" => "string",
            "enum" => [
                "af",
                "am",
                "ar",
                "hy",
                "az",
                "eu",
                "bn",
                "bg",
                "ca",
                "zh-CN",
                "zh-TW",
                "hr",
                "cs",
                "da",
                "nl",
                "en-GB",
                "en",
                "et",
                "fi",
                "fr",
                "fr-CA",
                "gl",
                "ka",
                "de",
                "el",
                "gu",
                "iw",
                "hi",
                "hu",
                "is",
                "id",
                "ga",
                "it",
                "ja",
                "kn",
                "km",
                "ko",
                "lo",
                "lv",
                "lt",
                "ms",
                "ml",
                "mr",
                "mn",
                "ne",
                "no",
                "fa",
                "fil",
                "pl",
                "pt",
                "pt-BR",
                "pt-PT",
                "ro",
                "ru",
                "sr",
                "si",
                "sk",
                "sl",
                "es",
                "es-MX",
                "sw",
                "sv",
                "ta",
                "te",
                "tr",
                "uk",
                "ur",
                "vi",
                "cy",
                "zu",
            ],
            "required" => false,
            "description" => "language of returned content",
        ],
        "active_only" => [
            "type" => "boolean",
            "required" => false,
            "description" => "publication status filter; defaults to 'true' (only active publications are returned); 'false' returns active and inactive publications",
        ],
    ];
    protected const METHOD = "GET";
    protected const BASE_URL = "https://api.smartrecruiters.com";
    protected const PATH = "/jobs/{jobId}/publication";
    protected const PATH_PARAMS = [
        "jobId" => "job_id",
    ];
    protected const QUERY_PARAMS = [
        "activeOnly" => "active_only",
    ];
    protected const HEADER_PARAMS = [
        "Accept-Language" => "accept_language",
    ];
    protected const QUERY_STYLES = [];
    protected const BODY_REQUIRED = false;
    protected const BODY_MODE = "json";
    protected const AUTH_MODE = "either";
}
