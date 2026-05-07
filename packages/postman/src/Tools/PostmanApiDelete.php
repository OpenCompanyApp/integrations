<?php

namespace OpenCompany\Integrations\Postman\Tools;

/** Guarded raw DELETE request for relative Postman API paths. */
class PostmanApiDelete extends AbstractPostmanRawTool
{
    protected const NAME = 'postman_api_delete';
    protected const DESCRIPTION = 'Call a safe relative Postman API DELETE path.';
    protected const METHOD = 'apiDelete';
}
