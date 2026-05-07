<?php

namespace OpenCompany\Integrations\OpenFda\Tools;

/**
 * Query tobacco product problem reports.
 */
class OpenFdaTobaccoProblem extends AbstractOpenFdaDatasetTool
{
    protected const NAME = 'openfda_tobacco_problem';
    protected const DESCRIPTION = 'Query the openFDA tobacco problem reports endpoint.';
    protected const ENDPOINT = 'tobacco/problem';
}
