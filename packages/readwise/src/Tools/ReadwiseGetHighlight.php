<?php
namespace OpenCompany\Integrations\Readwise\Tools;
/** Get one Readwise highlight. */
class ReadwiseGetHighlight extends AbstractReadwiseTool { protected const NAME = 'readwise_get_highlight'; protected const DESCRIPTION = 'Get one Readwise highlight by highlight_id.'; protected const OPERATION = 'get_highlight'; protected const REQUIRED = ['highlight_id']; }
