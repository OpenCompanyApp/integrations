<?php

namespace OpenCompany\Integrations\LangSmith\Tools;

/**
 * Validate Example.
 *
 * Maps to the official LangSmith endpoint POST /api/v1/examples/validate.
 */
class LangSmithValidateExample extends AbstractLangSmithTool
{
    protected const NAME = 'langsmith_validate_example';
    protected const DESCRIPTION = 'Validate Example

Official endpoint: POST /api/v1/examples/validate
Validate an example.';
    protected const PARAMETERS = array (
);
    protected const METHOD = 'POST';
    protected const PATH = '/api/v1/examples/validate';
    protected const PATH_PARAMS = array (
);
    protected const QUERY_KEYS = array (
);
    protected const BODY_REQUIRED = false;
    protected const MULTIPART = false;
}
