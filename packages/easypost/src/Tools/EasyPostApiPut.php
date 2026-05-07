<?php

namespace OpenCompany\Integrations\EasyPost\Tools;

/**
 * Guarded raw PUT request for relative EasyPost API paths.
 */
class EasyPostApiPut extends AbstractEasyPostRawTool
{
    protected const NAME = 'easypost_api_put';
    protected const DESCRIPTION = 'Call a safe relative EasyPost API PUT path.';
    protected const METHOD = 'apiPut';
}
