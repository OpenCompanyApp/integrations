<?php
namespace OpenCompany\Integrations\Readwise\Tools;
/** Create a tag on a Readwise highlight. */
class ReadwiseCreateHighlightTag extends AbstractReadwiseTool { protected const NAME = 'readwise_create_highlight_tag'; protected const DESCRIPTION = 'Create a tag on a Readwise highlight.'; protected const OPERATION = 'create_highlight_tag'; protected const REQUIRED = ['highlight_id', 'name']; }
