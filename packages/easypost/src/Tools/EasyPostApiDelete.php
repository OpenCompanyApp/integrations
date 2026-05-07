<?php

namespace OpenCompany\Integrations\EasyPost\Tools;

/**
 * Guarded raw DELETE request for relative EasyPost API paths.
 */
class EasyPostApiDelete extends AbstractEasyPostRawTool
{
    protected const NAME = 'easypost_api_delete';
    protected const DESCRIPTION = 'Call a safe relative EasyPost API DELETE path.';
    protected const METHOD = 'apiDelete';
}
