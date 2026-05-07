<?php

namespace OpenCompany\Integrations\Buffer\Tools;

/**
 * Deauthorize the current Buffer API token.
 */
class BufferDeauthorizeUser extends AbstractBufferTool
{
    protected const NAME = 'buffer_deauthorize_user';
    protected const DESCRIPTION = 'Deauthorize the current Buffer API token.';
    protected const METHOD = 'deauthorizeUser';
}
