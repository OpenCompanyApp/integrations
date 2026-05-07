<?php

namespace OpenCompany\Integrations\EasyPost\Tools;

/**
 * Guarded raw POST request for relative EasyPost API paths.
 */
class EasyPostApiPost extends AbstractEasyPostRawTool
{
    protected const NAME = 'easypost_api_post';
    protected const DESCRIPTION = 'Call a safe relative EasyPost API POST path.';
    protected const METHOD = 'apiPost';
}
