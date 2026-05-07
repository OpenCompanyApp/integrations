<?php
namespace OpenCompany\Integrations\Readwise\Tools;
/** List tags for a Readwise highlight. */
class ReadwiseListHighlightTags extends AbstractReadwiseTool { protected const NAME = 'readwise_list_highlight_tags'; protected const DESCRIPTION = 'List tags for a Readwise highlight.'; protected const OPERATION = 'list_highlight_tags'; protected const REQUIRED = ['highlight_id']; }
