<?php

namespace OpenCompany\Integrations\OpenFigi\Tools;

/**
 * Retrieve the OpenFIGI OpenAPI schema.
 */
class OpenFigiSchema extends AbstractOpenFigiTool
{
    protected const NAME = 'openfigi_schema';
    protected const DESCRIPTION = 'Retrieve the current OpenFIGI OpenAPI schema.';
    protected const METHOD = 'schema';
    protected const PARAMETERS = [];
}
