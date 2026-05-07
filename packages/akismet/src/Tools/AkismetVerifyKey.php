<?php

namespace OpenCompany\Integrations\Akismet\Tools;

/**
 * Verify an Akismet API key and blog URL.
 */
class AkismetVerifyKey extends AbstractAkismetTool
{
    protected const NAME = 'akismet_verify_key';
    protected const DESCRIPTION = 'Verify the configured Akismet API key and blog URL, or a per-call blog URL override.';
    protected const METHOD = 'verifyKey';
    protected const PARAMETERS = [
        'blog' => ['type' => 'string', 'required' => false, 'description' => 'Optional front-page URL override for this verification request.'],
    ];
}
