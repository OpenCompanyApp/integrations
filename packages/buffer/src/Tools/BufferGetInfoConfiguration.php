<?php

namespace OpenCompany\Integrations\Buffer\Tools;

/**
 * Get Buffer REST API configuration metadata.
 */
class BufferGetInfoConfiguration extends AbstractBufferTool
{
    protected const NAME = 'buffer_get_info_configuration';
    protected const DESCRIPTION = 'Get Buffer API configuration metadata for services, limits, media, and analytics filters.';
    protected const METHOD = 'getInfoConfiguration';
}
