<?php

namespace OpenCompany\Integrations\LangSmith\Tools;

/**
 * Validate Examples.
 *
 * Maps to the official LangSmith endpoint POST /api/v1/examples/validate/bulk.
 */
class LangSmithValidateExamples extends AbstractLangSmithTool
{
    protected const NAME = 'langsmith_validate_examples';
    protected const DESCRIPTION = 'Validate Examples

Official endpoint: POST /api/v1/examples/validate/bulk
Validate examples in bulk.';
    protected const PARAMETERS = array (
);
    protected const METHOD = 'POST';
    protected const PATH = '/api/v1/examples/validate/bulk';
    protected const PATH_PARAMS = array (
);
    protected const QUERY_KEYS = array (
);
    protected const BODY_REQUIRED = false;
    protected const MULTIPART = false;
}
