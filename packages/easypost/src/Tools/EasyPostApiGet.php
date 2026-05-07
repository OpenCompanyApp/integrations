<?php

namespace OpenCompany\Integrations\EasyPost\Tools;

/**
 * Guarded raw GET request for relative EasyPost API paths.
 */
class EasyPostApiGet extends AbstractEasyPostRawTool
{
    protected const NAME = 'easypost_api_get';
    protected const DESCRIPTION = 'Call a safe relative EasyPost API GET path.';
    protected const METHOD = 'apiGet';
}
