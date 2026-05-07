<?php

namespace OpenCompany\Integrations\EasyPost\Tools;

/**
 * Guarded raw PATCH request for relative EasyPost API paths.
 */
class EasyPostApiPatch extends AbstractEasyPostRawTool
{
    protected const NAME = 'easypost_api_patch';
    protected const DESCRIPTION = 'Call a safe relative EasyPost API PATCH path.';
    protected const METHOD = 'apiPatch';
}
