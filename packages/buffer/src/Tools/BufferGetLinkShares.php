<?php

namespace OpenCompany\Integrations\Buffer\Tools;

/**
 * Get Buffer share count for a URL.
 */
class BufferGetLinkShares extends AbstractBufferTool
{
    protected const NAME = 'buffer_get_link_shares';
    protected const DESCRIPTION = 'Get the number of Buffer shares for a URL.';
    protected const METHOD = 'getLinkShares';
    protected const ARGUMENTS = ['url'];
    protected const REQUIRED = ['url'];
}
