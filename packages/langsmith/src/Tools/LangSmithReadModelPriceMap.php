<?php

namespace OpenCompany\Integrations\LangSmith\Tools;

/**
 * Read Model Price Map.
 *
 * Maps to the official LangSmith endpoint GET /api/v1/model-price-map.
 */
class LangSmithReadModelPriceMap extends AbstractLangSmithTool
{
    protected const NAME = 'langsmith_read_model_price_map';
    protected const DESCRIPTION = 'Read Model Price Map

Official endpoint: GET /api/v1/model-price-map
Read Model Price Map.';
    protected const PARAMETERS = array (
);
    protected const METHOD = 'GET';
    protected const PATH = '/api/v1/model-price-map';
    protected const PATH_PARAMS = array (
);
    protected const QUERY_KEYS = array (
);
    protected const BODY_REQUIRED = false;
    protected const MULTIPART = false;
}
