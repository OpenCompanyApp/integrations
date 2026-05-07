<?php

namespace OpenCompany\Integrations\Postman\Tools;

/** Guarded raw PUT request for relative Postman API paths. */
class PostmanApiPut extends AbstractPostmanRawTool
{
    protected const NAME = 'postman_api_put';
    protected const DESCRIPTION = 'Call a safe relative Postman API PUT path.';
    protected const METHOD = 'apiPut';
}
