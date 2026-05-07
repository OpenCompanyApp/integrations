<?php

namespace OpenCompany\Integrations\Postman\Tools;

/** Guarded raw POST request for relative Postman API paths. */
class PostmanApiPost extends AbstractPostmanRawTool
{
    protected const NAME = 'postman_api_post';
    protected const DESCRIPTION = 'Call a safe relative Postman API POST path.';
    protected const METHOD = 'apiPost';
}
