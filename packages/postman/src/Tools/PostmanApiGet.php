<?php

namespace OpenCompany\Integrations\Postman\Tools;

/** Guarded raw GET request for relative Postman API paths. */
class PostmanApiGet extends AbstractPostmanRawTool
{
    protected const NAME = 'postman_api_get';
    protected const DESCRIPTION = 'Call a safe relative Postman API GET path.';
    protected const METHOD = 'apiGet';
}
