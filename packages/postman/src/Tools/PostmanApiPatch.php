<?php

namespace OpenCompany\Integrations\Postman\Tools;

/** Guarded raw PATCH request for relative Postman API paths. */
class PostmanApiPatch extends AbstractPostmanRawTool
{
    protected const NAME = 'postman_api_patch';
    protected const DESCRIPTION = 'Call a safe relative Postman API PATCH path.';
    protected const METHOD = 'apiPatch';
}
